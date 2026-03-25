<?php

namespace App\Services;

use App\Interfaces\ProductServiceInterface;
use App\Models\CarMake;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as SupportCollection;

class ProductService implements ProductServiceInterface
{
    public function getFeatured(int $limit = 8): Collection
    {
        return Product::with(['category', 'carModels.carMake'])
            ->where('is_active', true)
            ->latest()
            ->take($limit)
            ->get();
    }

    public function getCatalog(Request $request, ?string $slug = null): array
    {
        $categories = Category::with('children')
            ->withCount('products')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        $category = $slug
            ? Category::where('slug', $slug)->firstOrFail()
            : null;

        $carMakes = CarMake::with('carModels')->orderBy('name')->get();

        $query = Product::with(['category', 'carModels.carMake'])
            ->where('is_active', true);

        if ($category) {
            $descendantIds = $category->getDescendantIds();
            $allIds = array_merge([$category->id], $descendantIds);
            $query->whereIn('category_id', $allIds);
        }


        // Обычные фильтры по марке/модели из формы
        if ($request->filled('make')) {
            $query->whereHas('carModels.carMake', fn($q) => $q->where('id', (int)$request->make)
            );
        }

        if ($request->filled('model')) {
            $query->whereHas('carModels', fn($q) => $q->where('id', (int)$request->model)
            );
        }


        // Остальные фильтры (бренд, цена, наличие, поиск) работают всегда
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float)$request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float)$request->price_max);
        }

        if ($request->boolean('in_stock')) {
            $query->where('quantity', '>', 0);
        }

        if ($request->filled('q')) {
            $search = trim($request->string('q'));
            $query->where(fn($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%")
                ->orWhere('brand', 'like', "%{$search}%")
            );
        }

        // Сортировка
        match ($request->get('sort')) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            'name_desc' => $query->orderBy('name', 'desc'),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();
        $brands = $this->getBrands($category?->id);

        return compact('products', 'categories', 'category', 'carMakes', 'brands');
    }


    /**
     * Нормализация строки (убираем пробелы, приводим к нижнему регистру)
     */
    private function normalizeString($string)
    {
        if (empty($string)) {
            return '';
        }

        $normalized = preg_replace('/\s+/', '', trim($string));
        $normalized = mb_strtolower($normalized);
        $normalized = preg_replace('/[^a-zа-яё0-9]/u', '', $normalized);

        return $normalized;
    }

    public function getProduct(Product $product): array
    {
        abort_if(!$product->is_active, 404);

        $product->load(['category.parent.parent.parent', 'carModels.carMake', 'analogs']);

        $related = Product::with(['category'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->orderByDesc('quantity')
            ->take(4)
            ->get();

        $fitsByMake = $product->carModels
            ->groupBy(fn($model) => $model->carMake->name);

        $category = $product->category;

        return compact('product', 'related', 'fitsByMake', 'category');
    }

    public function getBrands(?int $categoryId = null): SupportCollection
    {
        $query = Product::where('is_active', true)
            ->whereNotNull('brand')
            ->distinct();

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->orderBy('brand')->pluck('brand');
    }


}
