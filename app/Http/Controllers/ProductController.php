<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductServiceInterface;
use App\Models\CarModel;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductServiceInterface $products,
    ) {}

    public function home(): View
    {
        return view('welcome', [
            'featured'   => $this->products->getFeatured(8),
            'categories' => \App\Models\Category::with(['children' => fn($q) => $q->withCount('products')])
                ->withCount('products')
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function catalog(Request $request, string $slug = null): View
    {
        return view('catalog.index', $this->products->getCatalog($request, $slug));
    }

    public function show(Product $product): View
    {
        return view('catalog.show', $this->products->getProduct($product));
    }

    public function carModelsByMake(Request $request): JsonResponse
    {
        $request->validate(['make_id' => ['required', 'exists:car_makes,id']]);

        return response()->json(
            CarModel::where('car_make_id', $request->integer('make_id'))
                ->orderBy('name')
                ->get(['id', 'name'])
        );
    }
}
