<?php

namespace App\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceInterface
{
    /** Root categories with direct children — for navbar (cached). */
    public function getNavCategories(): Collection;

    /** Root categories with children + product counts — for home page / admin tree. */
    public function getTree(): Collection;

    /** All categories flat with product counts. */
    public function getAllWithCounts(): Collection;

    /** Flat list for <select> with depth indentation. */
    public function getFlatTree(?int $excludeId = null): \Illuminate\Support\Collection;

    /** Find category by slug with parent chain and children loaded. */
    public function findBySlug(string $slug): Category;

    /** Clear nav cache — call after any category change. */
    public function clearCache(): void;
}
