@extends('layouts.layout')

@section('title', __('welcome.title'))

@push('styles')
    @vite(['resources/css/welcome.css'])
@endpush

@section('content')

    <x-flash-message/>

    {{-- ── HERO ── --}}
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-eyebrow">{{ __('welcome.hero.eyebrow') }}</div>
            <h1>{!! __('welcome.hero.title') !!}</h1>
            <p class="hero-sub">
                {{ __('welcome.hero.subtitle') }}
            </p>
            <div class="hero-actions">
                <a href="{{ route('catalog') }}" class="hero-btn hero-btn-white">{{ __('welcome.hero.catalog_btn') }}</a>
                <a href="{{ route('catalog') }}?q=" class="hero-btn hero-btn-ghost">{{ __('welcome.hero.filter_btn') }}</a>
            </div>
            <div class="hero-stats">
                <div>
                    <div class="hero-stat-value">{{ \App\Models\Product::where('is_active',true)->count() }}+</div>
                    <div class="hero-stat-label">{{ __('welcome.hero.stats.products') }}</div>
                </div>
                <div>
                    <div class="hero-stat-value">15+</div>
                    <div class="hero-stat-label">{{ __('welcome.hero.stats.brands') }}</div>
                </div>
                <div>
                    <div class="hero-stat-value">{{ __('welcome.hero.stats.delivery_day') }}</div>
                    <div class="hero-stat-label">{{ __('welcome.hero.stats.delivery') }}</div>
                </div>
            </div>
        </div>

        {{-- ── HERO VISUAL (остается без изменений) ── --}}
        <div class="hero-visual">
            <div class="hero-engine-wrap">
                <img src="{{ asset('images/spark_plug.png') }}"
                     alt="Свеча зажигания"
                     class="hero-part-img">

                <svg class="hero-network-bg" viewBox="0 0 460 460" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="230" cy="230" r="200" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1.5"
                            stroke-dasharray="6 8"/>
                    <circle cx="230" cy="230" r="150" fill="none" stroke="rgba(255,255,255,0.07)" stroke-width="1"
                            stroke-dasharray="4 6"/>
                    <line x1="230" y1="30" x2="230" y2="430" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
                    <line x1="30" y1="230" x2="430" y2="230" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
                </svg>

                <svg class="hero-network-fg" viewBox="0 0 460 460" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="400.0" cy="230.0" r="5" fill="rgba(255,215,0,0.9)" class="brand-dot"
                            style="animation-delay:0s"/>
                    <circle cx="350.2" cy="350.2" r="4.5" fill="rgba(255,100,100,0.9)" class="brand-dot"
                            style="animation-delay:0.4s"/>
                    <circle cx="230.0" cy="400.0" r="5" fill="rgba(100,200,255,0.9)" class="brand-dot"
                            style="animation-delay:0.8s"/>
                    <circle cx="109.8" cy="350.2" r="4.5" fill="rgba(150,255,150,0.9)" class="brand-dot"
                            style="animation-delay:1.2s"/>
                    <circle cx="60.0" cy="230.0" r="5" fill="rgba(255,150,255,0.9)" class="brand-dot"
                            style="animation-delay:1.6s"/>
                    <circle cx="109.8" cy="109.8" r="4.5" fill="rgba(255,200,100,0.9)" class="brand-dot"
                            style="animation-delay:2.0s"/>
                    <circle cx="230.0" cy="60.0" r="5" fill="rgba(200,200,200,0.9)" class="brand-dot"
                            style="animation-delay:2.4s"/>
                    <circle cx="350.2" cy="109.8" r="4.5" fill="rgba(100,100,255,0.9)" class="brand-dot"
                            style="animation-delay:2.8s"/>

                    <text x="420" y="215" text-anchor="start" font-size="10" font-weight="500" letter-spacing="1"
                          fill="white" font-family="sans-serif">BOSCH
                    </text>
                    <text x="360" y="370" text-anchor="start" font-size="10" font-weight="500" letter-spacing="1"
                          fill="white" font-family="sans-serif">VALEO
                    </text>
                    <text x="230" y="430" text-anchor="middle" font-size="10" font-weight="500" letter-spacing="1"
                          fill="white" font-family="sans-serif">DENSO
                    </text>
                    <text x="85" y="370" text-anchor="end" font-size="10" font-weight="500" letter-spacing="1"
                          fill="white" font-family="sans-serif">DELPHI
                    </text>
                    <text x="35" y="215" text-anchor="end" font-size="10" font-weight="500" letter-spacing="1"
                          fill="white" font-family="sans-serif">NGK
                    </text>
                    <text x="85" y="85" text-anchor="end" font-size="10" font-weight="500" letter-spacing="1"
                          fill="white" font-family="sans-serif">CHAMPION
                    </text>
                    <text x="230" y="30" text-anchor="middle" font-size="10" font-weight="500" letter-spacing="1"
                          fill="white" font-family="sans-serif">BREMI
                    </text>
                    <text x="360" y="85" text-anchor="start" font-size="10" font-weight="500" letter-spacing="1"
                          fill="white" font-family="sans-serif">BERU
                    </text>

                    <line x1="400" y1="230" x2="230" y2="230" stroke="rgba(255,255,255,0.15)" stroke-width="1"
                          stroke-dasharray="3 4"/>
                    <line x1="350.2" y1="350.2" x2="230" y2="230" stroke="rgba(255,255,255,0.15)" stroke-width="1"
                          stroke-dasharray="3 4"/>
                    <line x1="230" y1="400" x2="230" y2="230" stroke="rgba(255,255,255,0.15)" stroke-width="1"
                          stroke-dasharray="3 4"/>
                    <line x1="109.8" y1="350.2" x2="230" y2="230" stroke="rgba(255,255,255,0.15)" stroke-width="1"
                          stroke-dasharray="3 4"/>
                    <line x1="60" y1="230" x2="230" y2="230" stroke="rgba(255,255,255,0.15)" stroke-width="1"
                          stroke-dasharray="3 4"/>
                    <line x1="109.8" y1="109.8" x2="230" y2="230" stroke="rgba(255,255,255,0.15)" stroke-width="1"
                          stroke-dasharray="3 4"/>
                    <line x1="230" y1="60" x2="230" y2="230" stroke="rgba(255,255,255,0.15)" stroke-width="1"
                          stroke-dasharray="3 4"/>
                    <line x1="350.2" y1="109.8" x2="230" y2="230" stroke="rgba(255,255,255,0.15)" stroke-width="1"
                          stroke-dasharray="3 4"/>
                </svg>
            </div>
        </div>
    </section>

    {{-- ── CATEGORIES ── --}}
    <x-section-header
        :title="__('welcome.categories.title')"
        :link-url="route('catalog')"
        :link-label="__('welcome.categories.all_products')"
    />

    <div class="cat-grid">
        @php
            $icons = [
                'plugs'=>'⚡','coils'=>'🔌','caps'=>'🛡️','suspension'=>'🔩',
                'brakes'=>'🛑','filters'=>'🔵','oils'=>'🛢️','discs'=>'⭕',
                'thermostat'=>'🌡️','belts'=>'🔗','bearings'=>'⚙️','exhaust'=>'💨',
                'lights'=>'💡','battery'=>'🔋','cooling'=>'❄️',
                'engine'=>'🔧','body'=>'🚗','electrics'=>'⚡',
            ];
        @endphp
        @foreach($categories->where('parent_id', null) as $cat)
            @php
                $icon = $icons[$cat->slug] ?? '🔧';
                $totalProducts = $cat->products_count + $cat->children->sum('products_count');
            @endphp
            <a href="{{ route('catalog.category', $cat->slug) }}" class="cat-card">
                <div class="cat-icon">{{ $icon }}</div>
                <div class="cat-name"> {{ __("categories.{$cat->slug}") }}</div>
                @if($cat->description)
                    <div class="cat-desc">{{ Str::limit(__("category_descriptions.$cat->slug"), 55) }}</div>
                @endif
                @if($cat->children->isNotEmpty())
                    <div class="cat-children">
                        @foreach($cat->children->take(3) as $child)
                            <span class="cat-child-chip"> {{ __("categories.{$child->slug}") }}</span>
                        @endforeach
                        @if($cat->children->count() > 3)
                            <span class="cat-child-more">+{{ $cat->children->count() - 3 }}</span>
                        @endif
                    </div>
                @endif
                <div class="cat-meta">
                    <span class="cat-count">{{ $totalProducts }} {{ __('welcome.categories.products_count') }}</span>
                    <span class="cat-arrow">→</span>
                </div>
            </a>
        @endforeach
    </div>

    {{-- ── BRANDS ── --}}
    <div class="brands-strip">
        <div class="brands-label">{{ __('welcome.brands.label') }}</div>
        <div class="brands-row">
            @foreach(['Bosch','NGK','Denso','Delphi','Valeo','Champion','Bremi','Beru','Febi','Gates','Mann','Mahle','SKF','ZF','Lemförder'] as $brand)
                <a href="{{ route('catalog') }}?brand={{ $brand }}" class="brand-tag">{{ $brand }}</a>
            @endforeach
        </div>
    </div>

    {{-- ── POPULAR PRODUCTS ── --}}
    <x-section-header
        :title="__('welcome.popular.title')"
        :link-url="route('catalog')"
        :link-label="__('welcome.popular.view_all')"
    />

    <div class="product-grid">
        @forelse($featured as $product)
            <x-product-card :product="$product"/>
        @empty
            <div style="grid-column:1/-1; padding:3rem; text-align:center; background:var(--surface2); color:var(--muted); font-size:0.85rem;">
                {{ __('welcome.popular.empty') }}
            </div>
        @endforelse
    </div>

    {{-- ── PROMO BANNER ── --}}
    <div class="promo-banner">
        <div>
            <h3>{{ __('welcome.promo.title') }}</h3>
            <p>{{ __('welcome.promo.description') }}</p>
        </div>
        <a href="{{ route('catalog') }}" class="promo-btn">{{ __('welcome.promo.button') }}</a>
    </div>

    {{-- ── INFO STRIP ── --}}
    <div class="info-strip">
        <div class="info-item">
            <div class="info-icon">🚚</div>
            <div class="info-text">
                <strong>{{ __('welcome.info.delivery.title') }}</strong>
                <span>{{ __('welcome.info.delivery.text') }}</span>
            </div>
        </div>
        <div class="info-item">
            <div class="info-icon">✅</div>
            <div class="info-text">
                <strong>{{ __('welcome.info.original.title') }}</strong>
                <span>{{ __('welcome.info.original.text') }}</span>
            </div>
        </div>
        <div class="info-item">
            <div class="info-icon">↩️</div>
            <div class="info-text">
                <strong>{{ __('welcome.info.return.title') }}</strong>
                <span>{{ __('welcome.info.return.text') }}</span>
            </div>
        </div>
    </div>

@endsection
