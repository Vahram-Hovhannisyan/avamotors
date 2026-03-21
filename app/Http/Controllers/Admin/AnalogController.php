<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Analog;
use App\Models\Product;
use Illuminate\Http\Request;

class AnalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Analog::withCount('products');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(fn($sq) =>
                $sq->where('brand', 'like', "%$q%")
                   ->orWhere('sku',   'like', "%$q%")
            );
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        $analogs = $query->orderBy('brand')->orderBy('sku')->paginate(20)->withQueryString();
        $brands  = Analog::distinct()->orderBy('brand')->pluck('brand');

        return view('admin.analogs.index', compact('analogs', 'brands'));
    }

    public function create()
    {
        $brands = Analog::distinct()->orderBy('brand')->pluck('brand');

        return view('admin.analogs.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'brand' => ['required', 'string', 'max:100'],
            'sku'   => ['required', 'string', 'max:100'],
            'note'  => ['nullable', 'string', 'max:255'],
        ]);

        $exists = Analog::where('brand', $data['brand'])->where('sku', $data['sku'])->exists();
        if ($exists) {
            return back()->withErrors(['sku' => 'Такой артикул уже существует для этого бренда.'])->withInput();
        }

        Analog::create($data);

        return redirect()->route('admin.analogs')
            ->with('success', "Аналог {$data['brand']} {$data['sku']} создан.");
    }

    public function edit(Analog $analog)
    {
        $analog->load('products');
        $brands = Analog::distinct()->orderBy('brand')->pluck('brand');

        return view('admin.analogs.edit', compact('analog', 'brands'));
    }

    public function update(Request $request, Analog $analog)
    {
        $data = $request->validate([
            'brand' => ['required', 'string', 'max:100'],
            'sku'   => ['required', 'string', 'max:100'],
            'note'  => ['nullable', 'string', 'max:255'],
        ]);

        $exists = Analog::where('brand', $data['brand'])
            ->where('sku', $data['sku'])
            ->where('id', '!=', $analog->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['sku' => 'Такой артикул уже существует.'])->withInput();
        }

        $analog->update($data);

        return redirect()->route('admin.analogs')
            ->with('success', "Аналог {$analog->brand} {$analog->sku} обновлён.");
    }

    public function destroy(Analog $analog)
    {
        $analog->products()->detach();
        $analog->delete();

        return back()->with('success', 'Аналог удалён.');
    }

    // ── Attach / Detach to product ─────────────────────

    public function attach(Request $request, Product $product)
    {
        $request->validate(['analog_id' => ['required', 'exists:analogs,id']]);

        $product->analogs()->syncWithoutDetaching([$request->analog_id]);

        return back()->with('success', 'Аналог привязан к товару.');
    }

    public function detach(Product $product, Analog $analog)
    {
        $product->analogs()->detach($analog->id);

        return back()->with('success', 'Аналог отвязан от товара.');
    }
}
