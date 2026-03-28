<?php

namespace App\Services;

use App\Interfaces\CategoryServiceInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryService implements CategoryServiceInterface
{
    private const CACHE_KEY = 'nav_categories';
    private const CACHE_TTL = 3600;

    /**
     * Root categories with direct children — for navbar (cached).
     */
    public function getNavCategories(): Collection
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return Category::with(['children' => fn($q) =>
            $q->orderBy('sort_order')->orderBy('name')
            ])
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(['id', 'parent_id', 'name', 'slug', 'sort_order']);
        });
    }

    /**
     * Root categories with children + product counts — for home page / tree views.
     */
    public function getTree(): Collection
    {
        return Category::with(['children' => fn($q) =>
        $q->withCount('products')->orderBy('sort_order')->orderBy('name')
        ])
            ->withCount('products')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    /**
     * All categories flat with product counts.
     */
    public function getAllWithCounts(): Collection
    {
        return Category::withCount('products')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    /**
     * Flat list for <select> with indentation — uses Category::flatTree().
     */
    public function getFlatTree(?int $excludeId = null): \Illuminate\Support\Collection
    {
        return Category::flatTree($excludeId);
    }

    /**
     * Find by slug with parent chain and direct children loaded.
     */
    public function findBySlug(string $slug): Category
    {
        return Category::with(['parent.parent.parent', 'children'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Clear nav.php cache — call after any category change.
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    // ── Backwards compatibility methods ───────────────
    // These exist for servers that may have the old interface

    /**
     * @deprecated Use getFlatTree() instead
     */
    public function getAllFlat(): Collection
    {
        return Category::orderBy('sort_order')->orderBy('name')->get();
    }

    /**
     * @deprecated Use getTree() instead
     */
    public function getRootWithChildren(): Collection
    {
        return $this->getTree();
    }

    /**
     * @deprecated Use getFlatTree() instead
     */
    public function getSelectOptions(?int $excludeId = null): array
    {
        return $this->getFlatTree($excludeId)->map(fn($item) => [
            'id'    => $item['category']->id,
            'label' => str_repeat('— ', $item['depth']) . $item['category']->name,
            'depth' => $item['depth'],
        ])->values()->toArray();
    }
}
