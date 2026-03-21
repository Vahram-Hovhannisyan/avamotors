@extends('layouts.layout')

@section('title', 'Редактировать: ' . $category->name . ' — Админ')

@push('styles')
    @vite(['resources/css/admin/categories.css'])
@endpush

@section('content')

    <nav class="breadcrumb-nav">
        <a href="{{ route('admin.categories') }}">Категории</a>
        @if($category->parent)
            <span class="sep">/</span>
            <a href="{{ route('admin.categories.edit', $category->parent) }}">{{ $category->parent->name }}</a>
        @endif
        <span class="sep">/</span>
        <strong>{{ $category->name }}</strong>
    </nav>

    <div class="page-header">
        <div>
            <h1 class="page-title">{{ $category->name }}</h1>
            <div class="page-meta" style="margin-top:0.2rem;">{{ $category->breadcrumbPath() }}</div>
        </div>
        <a href="{{ route('catalog.category', $category->slug) }}" target="_blank" class="quick-link">
            ↗ Открыть в каталоге
        </a>
    </div>

    <x-flash-message />

    @if($errors->any())
        <div class="error-box">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    <div class="quick-actions">
        <a href="{{ route('admin.categories') }}" class="quick-link">← Все категории</a>
        @if($category->parent)
            <a href="{{ route('admin.categories.edit', $category->parent) }}" class="quick-link">
                ↑ {{ $category->parent->name }}
            </a>
        @endif
        <a href="{{ route('admin.products') }}" class="quick-link">Товары</a>
    </div>

    <div class="edit-layout">

        {{-- ── FORM COLUMN ── --}}
        <div>

            {{-- Main form --}}
            <div class="form-card">
                <div class="form-card-title">Данные категории</div>
                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Родительская категория</label>
                        <select name="parent_id">
                            <option value="">— Корневая категория —</option>
                            @foreach($flatTree as $item)
                                <option value="{{ $item['category']->id }}"
                                    {{ old('parent_id', $category->parent_id) == $item['category']->id ? 'selected' : '' }}>
                                    {{ str_repeat('&nbsp;&nbsp;&nbsp;', $item['depth']) }}{{ $item['depth'] > 0 ? '└ ' : '' }}{{ $item['category']->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Название *</label>
                        <input type="text" name="name" id="cat-name"
                               value="{{ old('name', $category->name) }}" required>
                        @error('name') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Slug *</label>
                        <input type="text" name="slug" id="cat-slug"
                               value="{{ old('slug', $category->slug) }}"
                               class="monospace" required>
                        <div class="form-hint">Только a-z, 0-9, дефис</div>
                        <div class="url-preview">/catalog/<span id="slug-preview">{{ $category->slug }}</span></div>
                        @error('slug') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Порядок сортировки</label>
                        <input type="number" name="sort_order"
                               value="{{ old('sort_order', $category->sort_order) }}" min="0">
                        <div class="form-hint">Меньше = выше в списке среди сестринских категорий</div>
                    </div>

                    <div class="form-group">
                        <label>Описание</label>
                        <textarea name="description">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="save-btn">Сохранить</button>
                        <a href="{{ route('admin.categories') }}" class="form-cancel">Отмена</a>
                    </div>
                </form>
            </div>

            {{-- Danger zone --}}
            <div class="form-card danger">
                <div class="form-card-title">Опасная зона</div>

                @php
                    $hasProducts = ($category->products_count ?? 0) > 0;
                    $hasChildren = $category->children->isNotEmpty();
                @endphp

                @if($hasProducts || $hasChildren)
                    <p class="danger-text">
                        Нельзя удалить:
                        @if($hasProducts) содержит {{ $category->products_count }} товаров@endif
                        @if($hasProducts && $hasChildren) и @endif
                        @if($hasChildren) имеет {{ $category->children->count() }} подкатегорий@endif.
                    </p>
                    <button disabled class="btn-disabled">Удалить категорию</button>
                @else
                    <p class="danger-text">Категория пуста и не имеет подкатегорий. Можно безопасно удалить.</p>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                          onsubmit="return confirm('Удалить «{{ $category->name }}»?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-danger">Удалить категорию</button>
                    </form>
                @endif
            </div>

        </div>

        {{-- ── SIDEBAR ── --}}
        <div>

            <div class="info-card">
                <div class="info-card-header">Информация</div>
                <div class="info-row">
                    <span class="label">ID</span>
                    <span class="monospace">{{ $category->id }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Уровень</span>
                    <span>{{ $category->parent_id ? ($category->parent->parent_id ? '3-й' : '2-й') : '1-й (корень)' }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Slug</span>
                    <span class="brand-color">{{ $category->slug }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Товаров</span>
                    <span>{{ $category->products_count ?? 0 }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Подкатегорий</span>
                    <span>{{ $category->children->count() }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Создана</span>
                    <span class="date">{{ $category->created_at->format('d.m.Y') }}</span>
                </div>
            </div>

            @if($category->children->isNotEmpty())
                <div class="info-card">
                    <div class="info-card-header">
                        Подкатегории
                        <a href="{{ route('admin.categories') }}">Все →</a>
                    </div>
                    @foreach($category->children as $child)
                        <div class="subcat-item">
                            <div>
                                <div class="item-name">{{ $child->name }}</div>
                                <div class="item-slug">{{ $child->slug }}</div>
                            </div>
                            <a href="{{ route('admin.categories.edit', $child) }}" class="item-link">Ред.</a>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($category->products->isNotEmpty())
                <div class="info-card">
                    <div class="info-card-header">
                        Последние товары
                        <a href="{{ route('admin.products', ['category' => $category->id]) }}">Все →</a>
                    </div>
                    @foreach($category->products->take(5) as $product)
                        <div class="info-row">
                            <div>
                                <div class="item-name">{{ Str::limit($product->name, 26) }}</div>
                                <div class="item-sku">{{ $product->sku }}</div>
                            </div>
                            <a href="{{ route('admin.products.edit', $product) }}" class="item-link">Ред.</a>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

    </div>

@endsection

@push('scripts')
    @vite(['resources/js/admin/categories.js'])
@endpush
