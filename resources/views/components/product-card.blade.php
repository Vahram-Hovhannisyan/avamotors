@props(['product', 'showCategory' => true, 'compact' => false])

@php
    // Get pricing information
    $user = auth()->user();
    $originalPrice = $product->price;
    $finalPrice = $product->final_price ?? $product->getPriceForUser($user);
    $hasDiscount = $product->has_discount ?? $product->hasSpecialPriceForUser($user);
    $discountInfo = $product->discount_info ?? $product->getDiscountForUser($user);
@endphp

@push('styles')
    <style>
        .product-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-top: 2px solid transparent;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
        }

        .product-card:hover {
            border-top-color: var(--brand);
            box-shadow: 0 8px 24px rgba(10, 27, 72, 0.10);
            transform: translateY(-2px);
        }

        /* ── Badges ── */
        .product-badge {
            position: absolute;
            top: 0.6rem;
            left: 0.6rem;
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.2rem 0.55rem;
            z-index: 1;
        }

        .product-badge.low {
            background: rgba(237, 137, 54, 0.15);
            color: #ed8936;
        }

        .product-badge.discount {
            background: rgba(239, 68, 68, 0.9);
            color: white;
            left: auto;
            right: 0.6rem;
        }

        /* ── Body ── */
        .product-body {
            padding: 0.9rem;
            display: flex;
            flex-direction: column;
            flex: 1;
            gap: 0.25rem;
        }

        /* ── Category ── */
        .product-type {
            font-size: 0.65rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--brand);
            font-weight: 600;
        }

        /* ── SKU ── */
        .product-sku {
            font-size: 0.68rem;
            color: var(--muted);
            font-family: monospace;
            letter-spacing: 0.03em;
        }

        /* ── Name ── */
        .product-name {
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--ink);
            text-decoration: none;
            line-height: 1.4;
            margin-top: 0.15rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.2s;
        }

        .product-name:hover { color: var(--brand); }

        /* ── Brand ── */
        .product-brand {
            font-size: 0.72rem;
            color: var(--muted);
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        /* ── Price Styles ── */
        .product-price-wrapper {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .product-price {
            font-family: var(--font-display);
            font-size: 1.15rem;
            letter-spacing: 0.04em;
            color: var(--brand);
            font-weight: 600;
            white-space: nowrap;
        }

        .product-price-old {
            font-size: 0.75rem;
            color: var(--muted);
            text-decoration: line-through;
            white-space: nowrap;
        }

        .product-price-saved {
            font-size: 0.65rem;
            color: #10b981;
            white-space: nowrap;
        }

        .product-card.is-compact .product-price {
            font-size: 1rem;
        }

        .product-card.is-compact .product-price-old {
            font-size: 0.7rem;
        }

        /* ── Footer ── */
        .product-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            margin-top: auto;
            padding-top: 0.75rem;
            border-top: 1px solid var(--border);
        }

        /* Tier Badge */
        .product-tier-badge {
            font-size: 0.6rem;
            color: #8b5cf6;
            background: rgba(139, 92, 246, 0.1);
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
            display: inline-block;
            margin-top: 0.25rem;
        }
    </style>
@endpush

<div class="product-card {{ $compact ? 'is-compact' : '' }}">

    {{-- Stock badge --}}
    @if($product->quantity > 0 && $product->quantity < 5)
        <span class="product-badge low">Мало</span>
    @endif

    {{-- Discount badge --}}
    @if($hasDiscount && $discountInfo)
        <span class="product-badge discount">
            @if($discountInfo['type'] === 'percentage')
                -{{ $discountInfo['percent'] }}%
            @else
                -{{ number_format($discountInfo['amount'], 0) }} դր.
            @endif
        </span>
    @endif

    <x-product-image :product="$product" :size="$compact ? 'sm' : 'md'" />

    <div class="product-body">

        @if($showCategory)
            <div class="product-type">{{ $product->category->name }}</div>
        @endif

        <div class="product-sku">Арт. {{ $product->sku }}</div>

        <a href="{{ route('product.show', $product) }}" class="product-name">
            {{ $product->name }}
        </a>

        @if($product->brand)
            <div class="product-brand">{{ $product->brand }}</div>
        @endif

        <x-stock-badge :product="$product" />

        {{-- Tier info if applicable --}}
        @if($hasDiscount && $discountInfo && isset($discountInfo['tier_name']))
            <div class="product-tier-badge">
                {{ $discountInfo['tier_name'] }}
            </div>
        @endif

        <div class="product-footer">
            <div class="product-price-wrapper">
                @if($hasDiscount)
                    <div class="product-price-old">{{ number_format($originalPrice, 0) }} դր.</div>
                    <div class="product-price">{{ number_format($finalPrice, 0) }} դր.</div>
                    @if($discountInfo && $discountInfo['type'] === 'fixed')
                        <div class="product-price-saved">
                            Экономия {{ number_format($discountInfo['amount'], 0) }} դր.
                        </div>
                    @endif
                @else
                    <div class="product-price">{{ number_format($finalPrice, 0) }} դր.</div>
                @endif
            </div>
            <x-add-to-cart-button :product="$product" />
        </div>

    </div>

</div>
