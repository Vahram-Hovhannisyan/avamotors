@extends('layouts.layout')

@section('title', ($category ? $category->name : __('catalog.all_products')) . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/catalog.css'])
@endpush

@section('content')

    <x-flash-message />

    <div class="catalog-wrap">

        {{-- ── SIDEBAR ── --}}
        <aside class="sidebar">

            <div class="sidebar-block">
                <div class="sidebar-title">{{ __('catalog.categories') }}</div>
                <div class="sidebar-cat-search">
                    <input type="text" id="catSearch" placeholder="{{ __('catalog.search_categories') }}..." class="sidebar-search-input">
                </div>
                <div class="sidebar-body" id="catList">
                    <a href="{{ route('catalog') }}" class="cat-link {{ !$category ? 'active' : '' }}">
                        {{ __('catalog.all_products') }}
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
                                    {{ __("categories.{$cat->slug}") }}
                                    <span class="count">{{ $total }}</span>
                                </a>
                            @else
                                <div class="cat-accordion {{ $isOpen ? 'open' : '' }}">
                                    <div class="cat-accordion-trigger">
                                        <a href="{{ route('catalog.category', $cat->slug) }}"
                                           class="cat-accordion-name {{ $isActive ? 'active' : '' }}">
                                            {{ __("categories.{$cat->slug}") }}
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
                                                {{ __("categories.{$child->slug}") }}
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
                <div class="sidebar-title">{{ __('catalog.filters.by_car') }}</div>
                <div class="sidebar-body">
                    <form method="GET" action="{{ request()->url() }}" id="car-filter">
                        @if(request('q'))    <input type="hidden" name="q"    value="{{ request('q') }}"> @endif
                        @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

                        <input type="hidden" name="make"  id="make-value"  value="{{ request('make') }}">
                        <input type="hidden" name="model" id="model-value" value="{{ request('model') }}">

                        <span class="filter-label">{{ __('catalog.filters.make') }}</span>
                        <div class="custom-select" id="make-dropdown">
                            <div class="custom-select-trigger" id="make-trigger">
                                <span id="make-display">
                                    @php $selectedMake = $carMakes->firstWhere('id', request('make')); @endphp
                                    {{ $selectedMake ? $selectedMake->name : __('catalog.filters.all_makes') }}
                                </span>
                                <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8" width="10" height="10"><polyline points="2,3.5 5,6.5 8,3.5"/></svg>
                            </div>
                            <div class="custom-select-dropdown">
                                <input type="text" class="custom-select-search" placeholder="{{ __('catalog.filters.search_make') }}">
                                <div class="custom-select-options">
                                    <div class="custom-select-option {{ !request('make') ? 'active' : '' }}" data-value="">{{ __('catalog.filters.all_makes') }}</div>
                                    @foreach($carMakes as $make)
                                        <div class="custom-select-option {{ request('make') == $make->id ? 'active' : '' }}"
                                             data-value="{{ $make->id }}">{{ $make->name }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <span class="filter-label">{{ __('catalog.filters.model') }}</span>
                        <div class="custom-select" id="model-dropdown">
                            <div class="custom-select-trigger" id="model-trigger">
                                <span id="model-display">
                                    @php
                                        $selectedModel = null;
                                        if(request('model')) {
                                            foreach($carMakes as $mk) {
                                                $found = $mk->carModels->firstWhere('id', request('model'));
                                                if($found) { $selectedModel = $mk->name . ' ' . $found->name; break; }
                                            }
                                        }
                                    @endphp
                                    {{ $selectedModel ?? __('catalog.filters.all_models') }}
                                </span>
                                <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8" width="10" height="10"><polyline points="2,3.5 5,6.5 8,3.5"/></svg>
                            </div>
                            <div class="custom-select-dropdown">
                                <input type="text" class="custom-select-search" placeholder="{{ __('catalog.filters.search_model') }}">
                                <div class="custom-select-options" id="model-options">
                                    <div class="custom-select-option {{ !request('model') ? 'active' : '' }}" data-value="">{{ __('catalog.filters.all_models') }}</div>
                                    @foreach($carMakes as $make)
                                        @foreach($make->carModels as $model)
                                            <div class="custom-select-option {{ request('model') == $model->id ? 'active' : '' }}"
                                                 data-value="{{ $model->id }}"
                                                 data-make="{{ $make->id }}"
                                                 data-label="{{ $make->name }} {{ $model->name }}">
                                                {{ $model->name }}
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="filter-btn">{{ __('catalog.filters.apply') }}</button>

                        @if(request()->hasAny(['make','model','q','brand']))
                            <a href="{{ $category ? route('catalog.category', $category->slug) : route('catalog') }}"
                               class="reset-link">{{ __('catalog.filters.reset') }}</a>
                        @endif
                    </form>
                </div>
            </div>

            @if($brands->isNotEmpty())
                <div class="sidebar-block">
                    <div class="sidebar-title">{{ __('catalog.filters.brand') }}</div>
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
                        <span class="toolbar-sep">{{ __('catalog.breadcrumb_separator') }}</span>
                    @endif
                    @php
                        $productsCount = $products->total();
                        $productsWord = trans_choice('catalog.products', $productsCount);
                    @endphp
                    {{ __('catalog.products_found', ['count' => $productsCount, 'products' => $productsWord]) }}
                    @if(request('q'))
                        {{ __('catalog.by_request') }} «<strong>{{ request('q') }}</strong>»
                    @endif
                </div>
                <form method="GET">
                    @foreach(request()->except('sort') as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                    <select name="sort" class="sort-select" onchange="this.form.submit()">
                        <option value="">{{ __('catalog.sort.default') }}</option>
                        <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>{{ __('catalog.sort.price_asc') }}</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>{{ __('catalog.sort.price_desc') }}</option>
                        <option value="name_asc"   {{ request('sort') === 'name_asc'   ? 'selected' : '' }}>{{ __('catalog.sort.name_asc') }}</option>
                        <option value="name_desc"  {{ request('sort') === 'name_desc'  ? 'selected' : '' }}>{{ __('catalog.sort.name_desc') }}</option>
                    </select>
                </form>
            </div>

            <div class="product-grid">
                @forelse($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="empty-state">
                        <strong>{{ __('catalog.empty.title') }}</strong>
                        <p>{{ __('catalog.empty.message') }}</p>
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
