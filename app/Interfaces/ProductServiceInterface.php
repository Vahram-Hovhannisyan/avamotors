<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface ProductServiceInterface
{
    /**
     * Get featured products for the home page.
     */
    public function getFeatured(int $limit = 8): Collection;

    /**
     * Get paginated products for catalog with filters applied.
     */
    public function getCatalog(Request $request, ?string $slug = null): array;

    /**
     * Get a single product with all relations.
     * Throws 404 if product is inactive.
     */
    public function getProduct(Product $product): array;

    /**
     * Get available brands, optionally filtered by category.
     */
    public function getBrands(?int $categoryId = null): \Illuminate\Support\Collection;

    /**
     * Apply VIN filter to the product query.
     *
     * @param Builder $query
     * @param array $vehicle
     * @return void
     */
    public function applyVinFilter($query, array $vehicle): void;
}
