<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'parent_id', 'sort_order', 'translations'];

    protected $casts = [
        'translations' => 'array',
    ];

    // ─── Relations ────────────────────────────────────

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    /**
     * Children with their children (2 levels deep, no recursion).
     * Достаточно для нашего дерева max 3 уровня.
     */
    public function childrenWithSubs(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->with('children')
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // ─── Helpers ──────────────────────────────────────

    public function isRoot(): bool
    {
        return is_null($this->parent_id);
    }

    public function hasChildren(): bool
    {
        return $this->children->isNotEmpty();
    }

    /**
     * Get all descendant category IDs.
     * Loads children lazily only when called — safe, no infinite loop.
     */
    public function getDescendantIds(): array
    {
        // Load children if not already loaded
        if (!$this->relationLoaded('children')) {
            $this->load('children');
        }

        $ids = [];
        foreach ($this->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->getDescendantIds());
        }
        return $ids;
    }

    /**
     * Breadcrumb path from root to this category.
     */
    public function getBreadcrumb(): \Illuminate\Support\Collection
    {
        $crumbs = collect();
        $cat = $this;

        while ($cat) {
            $crumbs->prepend($cat);
            $cat = $cat->parent;
        }

        return $crumbs;
    }

    /**
     * Full path string: "Ходовая / Стойки"
     */
    public function getFullPathAttribute(): string
    {
        return $this->getBreadcrumb()->pluck('name')->implode(' / ');
    }

    /**
     * Depth level (0 = root, 1 = child, 2 = grandchild).
     */
    public function getDepthAttribute(): int
    {
        $depth = 0;
        $cat = $this;
        while ($cat->parent_id) {
            $depth++;
            $cat = $cat->parent;
        }
        return $depth;
    }

    /**
     * Flat list for <select> dropdowns with depth-based indentation.
     * Uses a single query — loads all categories then builds tree in PHP.
     *
     * @return \Illuminate\Support\Collection  of ['category' => Category, 'depth' => int]
     */
    public static function flatTree(?int $excludeId = null): \Illuminate\Support\Collection
    {
        // Load ALL categories in ONE query — no recursion
        $all = static::orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->keyBy('id');

        // Build parent → children map
        $childrenMap = [];
        foreach ($all as $cat) {
            if ($cat->parent_id !== null) {
                $childrenMap[$cat->parent_id][] = $cat->id;
            }
        }

        $result = collect();

        // Walk the tree iteratively using a stack
        $roots = $all->filter(fn($c) => $c->parent_id === null)->values();

        self::walkTree($roots, $all, $childrenMap, $result, 0, $excludeId);

        return $result;
    }

    private static function walkTree(
        $nodes,
        Collection $all,
        array $childrenMap,
        \Illuminate\Support\Collection &$result,
        int $depth,
        ?int $excludeId
    ): void
    {
        foreach ($nodes as $cat) {
            if ($cat->id === $excludeId) {
                continue;
            }

            $result->push(['category' => $cat, 'depth' => $depth]);

            if (!empty($childrenMap[$cat->id])) {
                $children = collect($childrenMap[$cat->id])
                    ->map(fn($id) => $all[$id])
                    ->filter();

                self::walkTree($children, $all, $childrenMap, $result, $depth + 1, $excludeId);
            }
        }
    }
}
