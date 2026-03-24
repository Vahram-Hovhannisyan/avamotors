@extends('layouts.layout')

@section('title', ($category ? $category->name : 'Каталог') . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/catalog.css'])
@endpush

@section('content')

    <x-flash-message />

    {{-- В начале файла, после x-flash-message --}}

    {{-- VIN успешный подбор (с товарами) --}}
    @if(session('vin_success'))
        <div class="vin-message vin-success">
            <span class="vin-message-icon">✅</span>
            <span>{{ session('vin_success') }}</span>
            <button class="vin-message-close" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif

    {{-- VIN предупреждение (авто найден, но товаров нет) --}}
    @if(session('vin_warning'))
        <div class="vin-message vin-warning">
            <span class="vin-message-icon">⚠️</span>
            <span>{{ session('vin_warning') }}</span>
            <button class="vin-message-close" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif

    {{-- VIN ошибка --}}
    @if(session('vin_error'))
        <div class="vin-message vin-error">
            <span class="vin-message-icon">❌</span>
            <span>{{ session('vin_error') }}</span>
            <button class="vin-message-close" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif

    {{-- Баннер активного VIN (с товарами или без) --}}
    @if(session('vin_decoded') && session('selected_vehicle'))
        <div class="vin-active-banner {{ session('vin_no_products') ? 'vin-no-products' : '' }}">
            <div class="vin-banner-icon">📄</div>
            <div class="vin-banner-info">
                <strong>Подобрано для:</strong>
                {{ session('selected_vehicle')['make'] ?? '?' }}
                {{ session('selected_vehicle')['model'] ?? '?' }}
                @if(session('selected_vehicle')['year'])
                    ({{ session('selected_vehicle')['year'] }})
                @endif
                <span class="vin-badge">VIN: {{ substr(session('selected_vin'), 0) }}</span>

                @if(session('compatible_products_count') > 0)
                    <span class="compatible-badge">✓ {{ session('compatible_products_count') }} совместимых товаров</span>
                @else
                    <span class="compatible-badge empty">⚠️ Товаров пока нет</span>
                @endif
            </div>
            <a href="{{ route('vin.clear') }}" class="vin-clear-btn">✕ Очистить</a>
        </div>
    @endif

    {{-- VIN промо-блок (показывается только если нет активного VIN) --}}
    @if(!session('vin_decoded'))
        <div class="vin-promo-card">
            <div class="vin-promo-content">
                <div class="vin-promo-icon">🔍🔢</div>
                <div class="vin-promo-text">
                    <h4>Точный подбор по VIN</h4>
                    <p>Введите VIN номер автомобиля — найдем запчасти, которые подходят именно вашему авто</p>
                    <div class="vin-promo-example">
                        <span class="example-label">Пример:</span>
                        <code>1HGBH41JXMN109186</code>
                    </div>
                </div>
                <a href="{{ route('vin.index') }}" class="vin-promo-btn">
                    Подобрать по VIN
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M3 8h10M9 4l4 4-4 4"/>
                    </svg>
                </a>
            </div>
        </div>
    @endif

    <div class="catalog-wrap">

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

                        {{-- Hidden inputs for form submit --}}
                        <input type="hidden" name="make"  id="make-value"  value="{{ request('make') }}">
                        <input type="hidden" name="model" id="model-value" value="{{ request('model') }}">

                        {{-- Make dropdown --}}
                        <span class="filter-label">Марка</span>
                        <div class="custom-select" id="make-dropdown">
                            <div class="custom-select-trigger" id="make-trigger">
                                <span id="make-display">
                                    @php $selectedMake = $carMakes->firstWhere('id', request('make')); @endphp
                                    {{ $selectedMake ? $selectedMake->name : '— Все марки —' }}
                                </span>
                                <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8" width="10" height="10"><polyline points="2,3.5 5,6.5 8,3.5"/></svg>
                            </div>
                            <div class="custom-select-dropdown">
                                <input type="text" class="custom-select-search" placeholder="Поиск марки...">
                                <div class="custom-select-options">
                                    <div class="custom-select-option {{ !request('make') ? 'active' : '' }}" data-value="">— Все марки —</div>
                                    @foreach($carMakes as $make)
                                        <div class="custom-select-option {{ request('make') == $make->id ? 'active' : '' }}"
                                             data-value="{{ $make->id }}">{{ $make->name }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Model dropdown --}}
                        <span class="filter-label">Модель</span>
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
                                    {{ $selectedModel ?? '— Все модели —' }}
                                </span>
                                <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8" width="10" height="10"><polyline points="2,3.5 5,6.5 8,3.5"/></svg>
                            </div>
                            <div class="custom-select-dropdown">
                                <input type="text" class="custom-select-search" placeholder="Поиск модели...">
                                <div class="custom-select-options" id="model-options">
                                    <div class="custom-select-option {{ !request('model') ? 'active' : '' }}" data-value="">— Все модели —</div>
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
