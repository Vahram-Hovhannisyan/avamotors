@extends('layouts.layout')

@section('title', $product->name . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/catalog.css'])
@endpush

@section('content')

    <x-flash-message />

    @php
        $user = auth()->user();
        $originalPrice = $product->price;
        $finalPrice = $product->final_price ?? $product->getPriceForUser($user);
        $hasDiscount = $product->has_discount ?? $product->hasSpecialPriceForUser($user);
        $discountInfo = $product->discount_info ?? $product->getDiscountForUser($user);
    @endphp

    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Главная</a>
        <span class="breadcrumb-sep">/</span>
        <a href="{{ route('catalog') }}">Каталог</a>
        @foreach($category->getBreadcrumb() as $crumb)
            <span class="breadcrumb-sep">/</span>
            @if($crumb->id === $category->id)
                <span>{{ $crumb->name }}</span>
            @else
                <a href="{{ route('catalog.category', $crumb->slug) }}">{{ $crumb->name }}</a>
            @endif
        @endforeach
        <span class="breadcrumb-sep">/</span>
        <span>{{ $product->name }}</span>
    </nav>

    <div class="product-layout">

        <div class="product-img-box">
            @if($product->image && file_exists(public_path('storage/' . $product->image)))
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            @else
                <svg viewBox="0 0 200 200" width="140" height="140" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="200" height="200" fill="var(--surface2)"/>
                    <path d="M40 140 L70 85 L105 118 L130 90 L160 140 Z" fill="var(--border)"/>
                    <circle cx="72" cy="68" r="16" fill="var(--border)"/>
                </svg>
            @endif
        </div>

        <div>
            <div class="product-category-label">{{ $product->category->name }}</div>
            <h1 class="product-title">{{ $product->name }}</h1>
            <div class="product-sku-label">Артикул: <strong>{{ $product->sku }}</strong></div>

            {{-- Price section with discount info --}}
            <div class="product-price-wrapper">
                @if($hasDiscount && $discountInfo)
                    <div class="product-price-old">{{ number_format($originalPrice, 0) }} դր.</div>
                    <div class="product-price-big">{{ number_format($finalPrice, 0) }} դր.</div>
                    <span class="discount-badge-large">
                        @if($discountInfo['type'] === 'percentage')
                            -{{ $discountInfo['percent'] }}%
                        @else
                            -{{ number_format($discountInfo['amount'], 0) }} դր.
                        @endif
                    </span>
                @else
                    <div class="product-price-big">{{ number_format($finalPrice, 0) }} դր.</div>
                @endif
            </div>

            {{-- Tier information --}}
            @if($hasDiscount && $discountInfo && isset($discountInfo['tier_name']))
                <div class="tier-info">
                    🎯 Специальная цена для уровня: <strong>{{ $discountInfo['tier_name'] }}</strong>
                </div>
            @endif

            {{-- Savings info for fixed discounts --}}
            @if($hasDiscount && $discountInfo && $discountInfo['type'] === 'fixed')
                <div class="savings-info">
                    💰 Экономия: <strong>{{ number_format($discountInfo['amount'], 0) }} դր.</strong>
                </div>
            @endif

            {{-- Original price info for percentage discounts --}}
            @if($hasDiscount && $discountInfo && $discountInfo['type'] === 'percentage')
                <div class="original-price-info">
                    Обычная цена: {{ number_format($originalPrice, 0) }} դր.
                </div>
            @endif

            @if($product->quantity > 5)
                <div class="stock-badge in">В наличии ({{ $product->quantity }} шт.)</div>
            @elseif($product->quantity > 0)
                <div class="stock-badge low">Осталось мало ({{ $product->quantity }} шт.)</div>
            @else
                <div class="stock-badge out">Нет в наличии</div>
            @endif

            <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="qty-row">
                    <input type="number" name="quantity" class="qty-input"
                           value="1" min="1" max="{{ $product->quantity }}"
                        {{ $product->quantity === 0 ? 'disabled' : '' }}>
                    <button type="submit" class="cart-btn-big"
                        {{ $product->quantity === 0 ? 'disabled' : '' }}>
                        В корзину
                    </button>
                </div>
            </form>

            <table class="meta-table">
                <tr>
                    <td>Бренд</td>
                    <td>{{ $product->brand ?? '—' }}</td>
                </tr>
                <tr>
                    <td>Категория</td>
                    <td><a href="{{ route('catalog.category', $product->category->slug) }}">{{ $product->category->name }}</a></td>
                </tr>
                <tr>
                    <td>Артикул</td>
                    <td>{{ $product->sku }}</td>
                </tr>
                <tr>
                    <td>На складе</td>
                    <td>{{ $product->quantity }} шт.</td>
                </tr>
                @if($hasDiscount && $discountInfo)
                    <tr>
                        <td>Тип скидки</td>
                        <td>
                            @if($discountInfo['type'] === 'percentage')
                                Процентная скидка ({{ $discountInfo['percent'] }}%)
                            @else
                                Фиксированная скидка ({{ number_format($discountInfo['amount'], 0) }} դր.)
                            @endif
                        </td>
                    </tr>
                @endif
            </table>

            @if($product->carModels->isNotEmpty())
                <div class="fits-label">Подходит для</div>
                <div class="fits-tags">
                    @foreach($fitsByMake as $makeName => $models)
                        @foreach($models as $model)
                            <span class="fit-tag">{{ $makeName }} {{ $model->name }}</span>
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    @if($product->description)
        <div class="desc-section">
            <h3>Описание</h3>
            <p>{{ $product->description }}</p>
        </div>
    @endif

    @if($product->analogs->isNotEmpty())
        <div class="analogs-section">
            <h2 class="related-title">Аналоги других производителей</h2>
            <div class="analogs-wrap">
                <table class="analogs-table">
                    <thead>
                    <tr>
                        <th>Бренд</th>
                        <th>Артикул</th>
                        <th>Примечание</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product->analogs->groupBy('brand') as $brand => $group)
                        @foreach($group as $i => $analog)
                            <tr>
                                <td>
                                    @if($i === 0)
                                        <span class="analog-brand-pill">{{ $brand }}</span>
                                    @endif
                                </td>
                                <td class="analog-sku">{{ $analog->sku }}</td>
                                <td class="analog-note">{{ $analog->note ?? '' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if($related->isNotEmpty())
        <div>
            <h2 class="related-title">Похожие товары</h2>
            <div class="related-grid">
                @foreach($related as $r)
                    <x-product-card :product="$r" :compact="true" />
                @endforeach
            </div>
        </div>
    @endif

@endsection
