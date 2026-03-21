<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Analog;
use App\Models\CarMake;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(fn($sq) =>
            $sq->where('name',  'like', "%$q%")
                ->orWhere('sku',   'like', "%$q%")
                ->orWhere('brand', 'like', "%$q%")
            );
        }

        if ($request->filled('category')) {
            $cat = Category::find($request->category);
            if ($cat) {
                $ids = array_merge([$cat->id], $cat->getDescendantIds());
                $query->whereIn('category_id', $ids);
            }
        }

        if ($request->filled('status')) {
            match ($request->status) {
                'active'    => $query->where('is_active', true),
                'inactive'  => $query->where('is_active', false),
                'low_stock' => $query->where('quantity', '>', 0)->where('quantity', '<', 5),
                'out_stock' => $query->where('quantity', 0),
                default     => null,
            };
        }

        $products = $query->orderBy('name')->paginate(25)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $carMakes = CarMake::with('carModels')->orderBy('name')->get();
        $analogs  = Analog::orderBy('brand')->orderBy('sku')->limit(200)->get();

        return view('admin.products.create', compact('carMakes', 'analogs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'sku'          => ['required', 'string', 'max:100', 'unique:products,sku'],
            'category_id'  => ['required', 'exists:categories,id'],
            'brand'        => ['nullable', 'string', 'max:100'],
            'description'  => ['nullable', 'string'],
            'price'        => ['required', 'numeric', 'min:0'],
            'quantity'     => ['required', 'integer', 'min:0'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'car_models'   => ['nullable', 'array'],
            'car_models.*' => ['exists:car_models,id'],
            'analogs'      => ['nullable', 'array'],
            'analogs.*'    => ['exists:analogs,id'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);
        $product->carModels()->sync($data['car_models'] ?? []);
        $product->analogs()->sync($data['analogs'] ?? []);

        return redirect()->route('admin.products.edit', $product)
            ->with('success', "Товар «{$product->name}» создан.");
    }

    public function edit(Product $product)
    {
        $product->load(['carModels', 'analogs']);
        $carMakes = CarMake::with('carModels')->orderBy('name')->get();
        $analogs  = Analog::orderBy('brand')->orderBy('sku')->limit(200)->get();

        $suggestions = Analog::whereNotIn('id', $product->analogs->pluck('id'))
            ->when(request('q'), fn($q, $s) =>
            $q->where(fn($sq) =>
            $sq->where('brand', 'like', "%$s%")
                ->orWhere('sku',   'like', "%$s%")
            )
            )
            ->orderBy('brand')->orderBy('sku')
            ->paginate(10);

        return view('admin.products.edit', compact('product', 'carMakes', 'analogs', 'suggestions'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'sku'          => ['required', 'string', 'max:100', 'unique:products,sku,' . $product->id],
            'category_id'  => ['required', 'exists:categories,id'],
            'brand'        => ['nullable', 'string', 'max:100'],
            'description'  => ['nullable', 'string'],
            'price'        => ['required', 'numeric', 'min:0'],
            'quantity'     => ['required', 'integer', 'min:0'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'car_models'   => ['nullable', 'array'],
            'car_models.*' => ['exists:car_models,id'],
            'analogs'      => ['nullable', 'array'],
            'analogs.*'    => ['exists:analogs,id'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->boolean('remove_image') && $product->image) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = null;
        }

        $product->update($data);
        $product->carModels()->sync($data['car_models'] ?? []);
        $product->analogs()->sync($data['analogs'] ?? []);

        return redirect()->route('admin.products')
            ->with('success', "Товар «{$product->name}» обновлён.");
    }

    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $name = $product->name;
        $product->delete();

        return back()->with('success', "Товар «{$name}» удалён.");
    }

    public function toggle(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        $status = $product->is_active ? 'активирован' : 'скрыт';

        return back()->with('success', "Товар «{$product->name}» {$status}.");
    }

    public function clone(Product $product)
    {
        $product->load(['carModels', 'analogs']);

        $clone = $product->replicate(['sku', 'image', 'quantity', 'created_at', 'updated_at']);
        $clone->name      = $product->name . ' (копия)';
        $clone->sku       = $product->sku . '-copy-' . time();
        $clone->quantity  = 0;
        $clone->is_active = false;
        $clone->image     = null;
        $clone->save();

        $clone->carModels()->sync($product->carModels->pluck('id'));
        $clone->analogs()->sync($product->analogs->pluck('id'));

        return redirect()
            ->route('admin.products.edit', $clone)
            ->with('success', "Товар «{$product->name}» клонирован. Проверьте данные и активируйте.");
    }
}
