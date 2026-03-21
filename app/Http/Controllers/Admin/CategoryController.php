<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryServiceInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryServiceInterface $categoryService,
    ) {}

    public function index(Request $request)
    {
        $query = Category::with(['parent', 'children' => fn($q) =>
        $q->withCount('products')->orderBy('sort_order')->orderBy('name')
        ])
            ->withCount('products')
            ->orderBy('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name');

        if ($request->filled('q')) {
            $s = $request->q;
            $query->where(fn($q) =>
            $q->where('name', 'like', "%$s%")
                ->orWhereHas('parent', fn($p) => $p->where('name', 'like', "%$s%"))
            );
        }

        $tree       = $query->paginate(15)->withQueryString();
        $totalCount = Category::count();

        return view('admin.categories.index', compact('tree', 'totalCount'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'slug'        => ['nullable', 'string', 'max:100', 'regex:/^[a-z0-9-]+$/'],
            'parent_id'   => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        $slug     = !empty($data['slug']) ? $data['slug'] : Str::slug($data['name']);
        $original = $slug;
        $count    = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }

        Category::create([
            'name'        => $data['name'],
            'slug'        => $slug,
            'parent_id'   => $data['parent_id'] ?? null,
            'description' => $data['description'] ?? null,
            'sort_order'  => $data['sort_order'] ?? 0,
        ]);

        $this->categoryService->clearCache();

        return redirect()->route('admin.categories')
            ->with('success', "Категория «{$data['name']}» создана.");
    }

    public function edit(Category $category)
    {
        $category->load(['parent', 'children' => fn($q) => $q->withCount('products')])
            ->loadCount('products')
            ->load(['products' => fn($q) => $q->latest()->take(6)]);

        $flatTree = $this->categoryService->getFlatTree($category->id);

        return view('admin.categories.edit', compact('category', 'flatTree'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100', 'unique:categories,name,' . $category->id],
            'slug'        => ['required', 'string', 'max:100', 'regex:/^[a-z0-9-]+$/', 'unique:categories,slug,' . $category->id],
            'parent_id'   => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        if (!empty($data['parent_id'])) {
            $descendantIds = $category->getDescendantIds();
            if (in_array((int) $data['parent_id'], $descendantIds) || (int) $data['parent_id'] === $category->id) {
                return back()->withErrors(['parent_id' => 'Нельзя выбрать дочернюю категорию как родительскую.'])->withInput();
            }
        }

        $category->update([
            'name'        => $data['name'],
            'slug'        => $data['slug'],
            'parent_id'   => $data['parent_id'] ?? null,
            'description' => $data['description'] ?? null,
            'sort_order'  => $data['sort_order'] ?? 0,
        ]);

        $this->categoryService->clearCache();

        return redirect()->route('admin.categories')
            ->with('success', "Категория «{$category->name}» обновлена.");
    }

    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return back()->withErrors(['error' => 'Нельзя удалить категорию с товарами.']);
        }

        if ($category->children()->exists()) {
            return back()->withErrors(['error' => 'Нельзя удалить категорию с подкатегориями.']);
        }

        $name = $category->name;
        $category->delete();
        $this->categoryService->clearCache();

        return back()->with('success', "Категория «{$name}» удалена.");
    }
}
