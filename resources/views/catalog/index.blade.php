@extends('layouts.layout')

@section('title', ($category ? $category->name : 'Каталог') . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/catalog.css'])
@endpush

@section('content')

    <x-flash-message />

    <div class="catalog-wrap">
        <button class="sidebar-toggle" onclick="this.nextElementSibling.classList.toggle('open')">
            Фильтры и категории <span>▼</span>
        </button>
        {{-- ── SIDEBAR ── --}}
        <aside class="sidebar">

            <div class="sidebar-block">
                <div class="sidebar-title">Категории</div>
                <div class="sidebar-cat-search">
                    <input type="text" id="catSearch" placeholder="Поиск категории..." class="sidebar-search-input">
                </div>
                <div class="sidebar-body" id="catList">
                    <a href="{{ route('catalog') }}" class="cat-link {{ !$category ? 'active' : '' }}">
                        Все товары
                    </a>
                    @foreach($categories as $cat)
                        @if($cat->isRoot())
                            @php
                                $isActive  = $category?->id === $cat->id;
                                $hasActive = $cat->children->contains('id', $category?->id);
                                $isOpen    = $isActive || $hasActive;
                                $total     = $cat->products->count() + $cat->children->sum(fn($c) => $c->products->count());
                            @endphp
                            @if($cat->children->isEmpty())
                                <a href="{{ route('catalog.category', $cat->slug) }}"
                                   class="cat-link {{ $isActive ? 'active' : '' }}">
                                    {{ $cat->name }}
                                    <span class="count">{{ $total }}</span>
                                </a>
                            @else
                                <div class="cat-accordion {{ $isOpen ? 'open' : '' }}">
                                    <div class="cat-accordion-trigger">
                                        <a href="{{ route('catalog.category', $cat->slug) }}"
                                           class="cat-accordion-name {{ $isActive ? 'active' : '' }}">
                                            {{ $cat->name }}
                                        </a>
                                        <span class="cat-accordion-count">{{ $total }}</span>
                                        <span class="cat-accordion-arrow">
                                            <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="2,3.5 5,6.5 8,3.5"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="cat-accordion-body">
                                        @foreach($cat->children as $child)
                                            <a href="{{ route('catalog.category', $child->slug) }}"
                                               class="cat-link {{ $category?->id === $child->id ? 'active' : '' }}">
                                                {{ $child->name }}
                                                <span class="count">{{ $child->products->count() }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="sidebar-block">
                <div class="sidebar-title">Подбор по авто</div>
                <div class="sidebar-body">
                    <form method="GET" action="{{ request()->url() }}" id="car-filter">
                        @if(request('q'))    <input type="hidden" name="q"    value="{{ request('q') }}"> @endif
                        @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

                        <span class="filter-label">Марка</span>
                        <select name="make" class="filter-select" id="make-select">
                            <option value="">— Все марки —</option>
                            @foreach($carMakes as $make)
                                <option value="{{ $make->id }}" {{ request('make') == $make->id ? 'selected' : '' }}>
                                    {{ $make->name }}
                                </option>
                            @endforeach
                        </select>

                        <span class="filter-label">Модель</span>
                        <select name="model" class="filter-select" id="model-select">
                            <option value="">— Все модели —</option>
                            @foreach($carMakes as $make)
                                @foreach($make->carModels as $model)
                                    <option value="{{ $model->id }}" data-make="{{ $make->id }}"
                                        {{ request('model') == $model->id ? 'selected' : '' }}>
                                        {{ $make->name }} {{ $model->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>

                        <button type="submit" class="filter-btn">Применить</button>

                        @if(request()->hasAny(['make','model','q','brand']))
                            <a href="{{ $category ? route('catalog.category', $category->slug) : route('catalog') }}"
                               class="reset-link">Сбросить фильтры</a>
                        @endif
                    </form>
                </div>
            </div>

            @if($brands->isNotEmpty())
                <div class="sidebar-block">
                    <div class="sidebar-title">Бренд</div>
                    <div class="sidebar-body">
                        @foreach($brands as $brand)
                            <a href="{{ request()->fullUrlWithQuery(['brand' => $brand]) }}"
                               class="cat-link {{ request('brand') === $brand ? 'active' : '' }}">
                                {{ $brand }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </aside>

        {{-- ── MAIN ── --}}
        <div>
            <div class="toolbar">
                <div class="toolbar-left">
                    @if($category)
                        @foreach($category->getBreadcrumb() as $i => $crumb)
                            @if($i > 0)<span class="toolbar-sep">/</span>@endif
                            @if($crumb->id === $category->id)
                                <strong>{{ $crumb->name }}</strong>
                            @else
                                <a href="{{ route('catalog.category', $crumb->slug) }}" class="toolbar-crumb">{{ $crumb->name }}</a>
                            @endif
                        @endforeach
                        <span class="toolbar-sep">—</span>
                    @endif
                    найдено <strong>{{ $products->total() }}</strong> {{ trans_choice('товар|товара|товаров', $products->total()) }}
                    @if(request('q')) по запросу «<strong>{{ request('q') }}</strong>» @endif
                </div>
                <form method="GET">
                    @foreach(request()->except('sort') as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                    <select name="sort" class="sort-select" onchange="this.form.submit()">
                        <option value="">По умолчанию</option>
                        <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Цена ↑</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Цена ↓</option>
                        <option value="name_asc"   {{ request('sort') === 'name_asc'   ? 'selected' : '' }}>По названию А-Я</option>
                        <option value="name_desc"  {{ request('sort') === 'name_desc'  ? 'selected' : '' }}>По названию Я-А</option>
                    </select>
                </form>
            </div>

            <div class="product-grid">
                @forelse($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="empty-state">
                        <strong>Товары не найдены</strong>
                        <p>Попробуйте изменить фильтры или поисковый запрос</p>
                    </div>
                @endforelse
            </div>

            {{ $products->links() }}
        </div>

    </div>

@endsection

@push('scripts')
    @vite(['resources/js/catalog.js'])
@endpush
