@extends('layouts.layout')

@section('title', __('cart.title') . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/cart.css'])
@endpush

@section('content')

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash-error">{{ session('error') }}</div>
    @endif

    <h1 class="page-title">{{ __('cart.title') }}</h1>

    @if(empty($items))
        <div class="empty-cart">
            <strong>{{ __('cart.empty.title') }}</strong>
            <p>{{ __('cart.empty.message') }}</p>
            <a href="{{ route('catalog') }}" class="checkout-btn inline">{{ __('cart.empty.button') }}</a>
        </div>
    @else
        <div class="cart-layout">

            <div>
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead>
                        里的
                        <th>{{ __('cart.table.product') }}</th>
                        <th>{{ __('cart.table.price') }}</th>
                        <th>{{ __('cart.table.quantity') }}</th>
                        <th>{{ __('cart.table.total') }}</th>
                        <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            @php
                                $product = $item['product'];
                                $hasDiscount = $item['has_discount'] ?? false;
                                $originalPrice = $item['original_price'] ?? $product->price;
                                $currentPrice = $item['price'];
                                $discountInfo = $item['discount_info'] ?? null;
                                $subtotal = $currentPrice * $item['quantity'];
                                $originalSubtotal = $originalPrice * $item['quantity'];
                                $savings = $originalSubtotal - $subtotal;
                            @endphp
                            <tr>
                                <td>
                                    <div class="cart-product-name">{{ $product->name }}</div>
                                    <div class="cart-product-sku">{{ __('cart.table.sku') }} {{ $product->sku }}</div>
                                    @if($hasDiscount)
                                        <div class="cart-discount-badge">
                                            @if($discountInfo && $discountInfo['type'] === 'percentage')
                                                -{{ $discountInfo['percent'] }}%
                                            @elseif($discountInfo && $discountInfo['type'] === 'fixed')
                                                -{{ number_format($discountInfo['amount'], 0) }} {{ __('cart.currency') }}
                                            @endif
                                            @if($discountInfo && isset($discountInfo['tier_name']))
                                                <span class="tier-name">({{ $discountInfo['tier_name'] }})</span>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($hasDiscount)
                                        <div class="price-wrapper">
                                            <span class="current-price">{{ number_format($currentPrice, 0, '.', ' ') }} {{ __('cart.currency') }}</span>
                                            <span class="old-price">{{ number_format($originalPrice, 0, '.', ' ') }} {{ __('cart.currency') }}</span>
                                        </div>
                                    @else
                                        <span class="current-price">{{ number_format($currentPrice, 0, '.', ' ') }} {{ __('cart.currency') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('cart.update') }}" class="update-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="number" name="quantity" class="qty-input"
                                               value="{{ $item['quantity'] }}" min="1"
                                               max="{{ $product->quantity }}"
                                               onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td class="cart-subtotal">
                                    <div class="subtotal-wrapper">
                                        <span class="subtotal-amount">{{ number_format($subtotal, 0, '.', ' ') }} {{ __('cart.currency') }}</span>
                                        @if($hasDiscount && $savings > 0)
                                            <span class="subtotal-savings">{{ __('cart.table.savings') }} {{ number_format($savings, 0, '.', ' ') }} {{ __('cart.currency') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('cart.remove') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="remove-btn">{{ __('cart.table.remove') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="cart-clear">
                    <form method="POST" action="{{ route('cart.clear') }}">
                        @csrf
                        <button type="submit" class="remove-btn"
                                onclick="return confirm('{{ __('cart.clear_confirm') }}')">{{ __('cart.clear_button') }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-title">{{ __('cart.summary.title') }}</div>

                @php
                    $totalOriginal = 0;
                    $totalDiscount = 0;
                    $totalFinal = 0;

                    foreach($items as $item) {
                        $product = $item['product'];
                        $originalPrice = $item['original_price'] ?? $product->price;
                        $currentPrice = $item['price'];
                        $quantity = $item['quantity'];

                        $totalOriginal += $originalPrice * $quantity;
                        $totalFinal += $currentPrice * $quantity;
                    }
                    $totalDiscount = $totalOriginal - $totalFinal;
                @endphp

                @foreach($items as $item)
                    @php
                        $product = $item['product'];
                        $hasDiscount = $item['has_discount'] ?? false;
                        $currentPrice = $item['price'];
                    @endphp
                    <div class="summary-row">
                        <span class="label">{{ Str::limit($product->name, 28) }}</span>
                        <div class="summary-item-price">
                            <span>{{ $item['quantity'] }} × {{ number_format($currentPrice, 0, '.', ' ') }} {{ __('cart.currency') }}</span>
                            @if($hasDiscount)
                                <span class="summary-discount-badge">{{ __('cart.summary.with_discount') }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach

                @if($totalDiscount > 0)
                    <div class="summary-discount">
                        <span>{{ __('cart.summary.discount') }}</span>
                        <span class="discount-amount">- {{ number_format($totalDiscount, 0, '.', ' ') }} {{ __('cart.currency') }}</span>
                    </div>
                @endif

                <div class="summary-total">
                    <span>{{ __('cart.summary.total') }}</span>
                    <div class="total-wrapper">
                        @if($totalDiscount > 0)
                            <span class="total-original">{{ number_format($totalOriginal, 0, '.', ' ') }} {{ __('cart.currency') }}</span>
                        @endif
                        <span class="total-final">{{ number_format($totalFinal, 0, '.', ' ') }} {{ __('cart.currency') }}</span>
                    </div>
                </div>

                {{-- Блок предупреждения для неавторизованных пользователей --}}
                @guest
                    <div class="cart-guest-warning">
                        <div class="warning-icon">🔒</div>
                        <div class="warning-content">
                            <strong>{{ __('cart.guest.title') }}</strong>
                            <p>{{ __('cart.guest.message') }}</p>
                        </div>
                    </div>
                @endguest

                @auth
                    <a href="{{ route('orders.checkout') }}" class="checkout-btn">{{ __('cart.summary.checkout') }}</a>
                @else
                    <a href="{{ route('login') }}" class="checkout-btn">{{ __('cart.summary.login_to_checkout') }}</a>
                @endauth
            </div>

        </div>
    @endif

@endsection
