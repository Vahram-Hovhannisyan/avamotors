@extends('layouts.layout')

@section('title', 'AVAMotors — Автозапчасти с доставкой по Армении')

@push('styles')
    @vite(['resources/css/welcome.css'])
@endpush

@section('content')

    <x-flash-message/>

    {{-- ── HERO ── --}}
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-eyebrow">Автозапчасти с доставкой</div>
            <h1>Всё для<br>вашего <em>авто</em><br>в одном месте</h1>
            <p class="hero-sub">
                Свечи, катушки, ходовая, тормоза, фильтры, масла — оригинал и проверенные аналоги Bosch, NGK, Denso,
                Delphi, Valeo и других ведущих брендов.
            </p>
            <div class="hero-actions">
                <a href="{{ route('catalog') }}" class="hero-btn hero-btn-white">Перейти в каталог</a>
                <a href="{{ route('catalog') }}?q=" class="hero-btn hero-btn-ghost">Подбор по авто</a>
            </div>
            <div class="hero-stats">
                <div>
                    <div class="hero-stat-value">{{ \App\Models\Product::where('is_active',true)->count() }}+</div>
                    <div class="hero-stat-label">Товаров в наличии</div>
                </div>
                <div>
                    <div class="hero-stat-value">15+</div>
                    <div class="hero-stat-label">Ведущих брендов</div>
                </div>
                <div>
                    <div class="hero-stat-value">1 день</div>
                    <div class="hero-stat-label">Доставка по Армении</div>
                </div>
            </div>
        </div>

        {{-- ── HERO VISUAL ── --}}
        <div class="hero-visual">
            <div class="hero-engine-wrap">

                {{-- Свеча зажигания (средний слой) --}}
                <img src="{{ asset('images/spark_plug.png') }}"
                     alt="Свеча зажигания"
                     class="hero-part-img">

                {{-- SVG фон: кольца (задний план) --}}
                <svg class="hero-network-bg" viewBox="0 0 460 460" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="230" cy="230" r="200" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1.5"
                            stroke-dasharray="6 8"/>
                    <circle cx="230" cy="230" r="150" fill="none" stroke="rgba(255,255,255,0.07)" stroke-width="1"
                            stroke-dasharray="4 6"/>

                    {{-- Легкие радиальные линии для эффекта --}}
                    <line x1="230" y1="30" x2="230" y2="430" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
                    <line x1="30" y1="230" x2="430" y2="230" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
                </svg>

                {{-- SVG передний: точки и подписи брендов по углам восьмиугольника --}}
                <svg class="hero-network-fg" viewBox="0 0 460 460" xmlns="http://www.w3.org/2000/svg">

                    {{-- Точки на углах восьмиугольника --}}
                    <circle cx="400.0" cy="230.0" r="5" fill="rgba(255,215,0,0.9)" class="brand-dot"
                            style="animation-delay:0s"/> {{-- BOSCH - золото --}}
                    <circle cx="350.2" cy="350.2" r="4.5" fill="rgba(255,100,100,0.9)" class="brand-dot"
                            style="animation-delay:0.4s"/> {{-- NGK - красный --}}
                    <circle cx="230.0" cy="400.0" r="5" fill="rgba(100,200,255,0.9)" class="brand-dot"
                            style="animation-delay:0.8s"/> {{-- DENSO - голубой --}}
                    <circle cx="109.8" cy="350.2" r="4.5" fill="rgba(150,255,150,0.9)" class="brand-dot"
                            style="animation-delay:1.2s"/> {{-- DELPHI - зеленый --}}
                    <circle cx="60.0" cy="230.0" r="5" fill="rgba(255,150,255,0.9)" class="brand-dot"
                            style="animation-delay:1.6s"/> {{-- VALEO - розовый --}}
                    <circle cx="109.8" cy="109.8" r="4.5" fill="rgba(255,200,100,0.9)" class="brand-dot"
                            style="animation-delay:2.0s"/> {{-- CHAMPION - оранжевый --}}
                    <circle cx="230.0" cy="60.0" r="5" fill="rgba(200,200,200,0.9)" class="brand-dot"
                            style="animation-delay:2.4s"/> {{-- BREMI - серебро --}}
                    <circle cx="350.2" cy="109.8" r="4.5" fill="rgba(100,100,255,0.9)" class="brand-dot"
                            style="animation-delay:2.8s"/> {{-- BERU - синий --}}

                    {{-- Подписи брендов --}}
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

                    {{-- Маленькие соединительные линии от точек к центру (для эффекта) --}}
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
    <x-section-header title="Категории запчастей" :link-url="route('catalog')" link-label="Все товары →"/>

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
                <div class="cat-name">{{ $cat->name }}</div>
                @if($cat->description)
                    <div class="cat-desc">{{ Str::limit($cat->description, 55) }}</div>
                @endif
                @if($cat->children->isNotEmpty())
                    <div class="cat-children">
                        @foreach($cat->children->take(3) as $child)
                            <span class="cat-child-chip">{{ $child->name }}</span>
                        @endforeach
                        @if($cat->children->count() > 3)
                            <span class="cat-child-more">+{{ $cat->children->count() - 3 }}</span>
                        @endif
                    </div>
                @endif
                <div class="cat-meta">
                    <span class="cat-count">{{ $totalProducts }} товаров</span>
                    <span class="cat-arrow">→</span>
                </div>
            </a>
        @endforeach
    </div>

    {{-- ── BRANDS ── --}}
    <div class="brands-strip">
        <div class="brands-label">Работаем с ведущими производителями</div>
        <div class="brands-row">
            @foreach(['Bosch','NGK','Denso','Delphi','Valeo','Champion','Bremi','Beru','Febi','Gates','Mann','Mahle','SKF','ZF','Lemförder'] as $brand)
                <a href="{{ route('catalog') }}?brand={{ $brand }}" class="brand-tag">{{ $brand }}</a>
            @endforeach
        </div>
    </div>

    {{-- ── POPULAR PRODUCTS ── --}}
    <x-section-header title="Популярные товары" :link-url="route('catalog')" link-label="Смотреть все →"/>

    <div class="product-grid">
        @forelse($featured as $product)
            <x-product-card :product="$product"/>
        @empty
            <div
                style="grid-column:1/-1; padding:3rem; text-align:center; background:var(--surface2); color:var(--muted); font-size:0.85rem;">
                Товары скоро появятся
            </div>
        @endforelse
    </div>

    {{-- ── PROMO BANNER ── --}}
    <div class="promo-banner">
        <div>
            <h3>Подбор по марке и модели авто</h3>
            <p>Не знаете какая запчасть нужна? Укажите марку авто — подберём за вас</p>
        </div>
        <a href="{{ route('catalog') }}" class="promo-btn">Подобрать запчасть →</a>
    </div>

    {{-- ── INFO STRIP ── --}}
    <div class="info-strip">
        <div class="info-item">
            <div class="info-icon">🚚</div>
            <div class="info-text">
                <strong>Быстрая доставка</strong>
                <span>По Армении от 1 дня. Бесплатно от 15 000 դր.</span>
            </div>
        </div>
        <div class="info-item">
            <div class="info-icon">✅</div>
            <div class="info-text">
                <strong>Только оригинал</strong>
                <span>Bosch, NGK, Denso, Delphi, Valeo, Febi и другие</span>
            </div>
        </div>
        <div class="info-item">
            <div class="info-icon">↩️</div>
            <div class="info-text">
                <strong>Возврат 30 дней</strong>
                <span>Вернём деньги если товар не подошёл</span>
            </div>
        </div>
    </div>

@endsection
