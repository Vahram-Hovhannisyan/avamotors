@extends('layouts.layout')

@section('title', 'Категории — Админ')

@push('styles')
    @vite(['resources/css/admin/categories.css'])
@endpush

@section('content')

    <div class="page-header">
        <h1 class="page-title">Категории</h1>
        <span class="page-meta">
            {{ $totalCount ?? \App\Models\Category::count() }} всего &nbsp;·&nbsp;
            {{ method_exists($tree, 'total') ? $tree->total() : $tree->count() }} корневых
        </span>
    </div>

    <x-flash-message />

    <div class="quick-actions">
        <a href="{{ route('admin.dashboard') }}" class="quick-link">← Дашборд</a>
        <a href="{{ route('admin.products') }}"  class="quick-link">Товары</a>
    </div>

    <form method="GET" class="search-form">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по названию...">
        <button type="submit">Найти</button>
        @if(request('q'))
            <a href="{{ route('admin.categories') }}" class="search-reset">✕</a>
        @endif
    </form>

    <div class="two-col">

        {{-- ── TREE TABLE ── --}}
        <div>
            <div class="table-wrap">
                <div class="table-header">
                    <span class="table-header-title">Все категории</span>
                    <span class="table-total">{{ $totalCount ?? \App\Models\Category::count() }} всего</span>
                </div>
                <table class="data-table">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Родитель</th>
                        <th>Slug</th>
                        <th>Товаров</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tree as $cat)
                        <tr>
                            <td>
                                @if($cat->parent_id)
                                    <span class="td-sep">└</span>
                                @endif
                                <span class="{{ $cat->parent_id ? '' : 'td-bold' }}">{{ $cat->name }}</span>
                                @if($cat->children->isNotEmpty())
                                    <span class="badge-pill">{{ $cat->children->count() }} подкат.</span>
                                @endif
                            </td>
                            <td class="td-muted">
                                @if($cat->parent)
                                    <a href="{{ route('admin.categories.edit', $cat->parent) }}" class="td-muted" style="text-decoration:none;">
                                        {{ $cat->parent->name }}
                                    </a>
                                @else
                                    <span style="color:var(--border);">—</span>
                                @endif
                            </td>
                            <td class="td-mono">{{ $cat->slug }}</td>
                            <td class="td-muted">{{ $cat->products_count }}</td>
                            <td class="td-nowrap">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="action-link">Ред.</a>
                                <a href="{{ route('catalog.category', $cat->slug) }}" target="_blank" class="action-link">↗</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}"
                                      style="display:inline"
                                      onsubmit="return confirm('Удалить «{{ $cat->name }}»?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="del-btn">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-cell">Категории не найдены</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($tree, 'links'))
                <div class="pagination-wrap">{{ $tree->links() }}</div>
            @endif
        </div>

        {{-- ── CREATE FORM ── --}}
        <div class="form-card">
            <div class="form-card-title">Новая категория</div>
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <div class="form-group">
                    <label>Родительская категория</label>
                    <select name="parent_id">
                        <option value="">— Корневая категория —</option>
                        @foreach(App\Models\Category::flatTree() as $item)
                            <option value="{{ $item['category']->id }}"
                                {{ old('parent_id') == $item['category']->id ? 'selected' : '' }}>
                                {{ str_repeat('&nbsp;&nbsp;&nbsp;', $item['depth']) }}{{ $item['depth'] > 0 ? '└ ' : '' }}{{ $item['category']->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-hint">Оставьте пустым для корневой категории</div>
                </div>

                <div class="form-group">
                    <label>Название *</label>
                    <input type="text" name="name" id="cat-name"
                           value="{{ old('name') }}" placeholder="Ходовая часть" required autocomplete="off">
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" id="cat-slug"
                           value="{{ old('slug') }}" placeholder="xodovaya-chast"
                           class="monospace" autocomplete="off">
                    <div class="form-hint">Только a-z, 0-9, дефис. Автозаполнение.</div>
                    @error('slug') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Порядок сортировки</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" step="1">
                    <div class="form-hint">Меньше = выше в списке</div>
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea name="description" placeholder="Краткое описание...">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="save-btn full">Добавить категорию</button>
            </form>
        </div>

    </div>

@endsection

@push('scripts')
    @vite(['resources/js/admin/categories.js'])
@endpush
