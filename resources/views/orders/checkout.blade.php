@extends('layouts.layout')

@section('title', 'Оформление заказа — AVAMotors')

@push('styles')
    @vite(['resources/css/orders.css'])
@endpush

@section('content')

    <h1 class="page-title">Оформление заказа</h1>

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        <div class="checkout-layout">

            <div>
                <div class="form-card">
                    <div class="form-card-title">Контактные данные</div>
                    <div class="form-group">
                        <label>Имя *</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                        @error('name') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Телефон *</label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                   placeholder="+374 (99) 00-00-00" required>
                            @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label>E-mail *</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                            @error('email') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">Адрес доставки</div>
                    <div class="form-group">
                        <label>Адрес</label>
                        <input type="text" name="address" value="{{ old('address') }}"
                               placeholder="Ереван, ул. Абовяна, 12, кв. 5">
                        @error('address') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Комментарий к заказу</label>
                        <textarea name="comment" placeholder="Любые пожелания...">{{ old('comment') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="order-summary">
                <div class="summary-title">Ваш заказ</div>

                @php
                    $totalOriginal = 0;
                    $totalDiscount = 0;
                    $totalFinal = 0;
                @endphp

                @foreach($items as $item)
                    @php
                        $product = $item['product'];
                        $hasDiscount = $item['has_discount'] ?? false;
                        $originalPrice = $item['original_price'] ?? $product->price;
                        $currentPrice = $item['price'];
                        $quantity = $item['quantity'];
                        $subtotal = $currentPrice * $quantity;
                        $originalSubtotal = $originalPrice * $quantity;
                        $savings = $originalSubtotal - $subtotal;

                        $totalOriginal += $originalSubtotal;
                        $totalFinal += $subtotal;
                        $totalDiscount += $savings;
                    @endphp

                    @if($product)
                        <div class="order-item {{ $hasDiscount ? 'has-discount' : '' }}">
                            <div class="order-item-info">
                                <div class="order-item-name">{{ $product->name }}</div>
                                <div class="order-item-sku">Арт. {{ $product->sku }}</div>
                                @if($hasDiscount)
                                    <div class="order-item-discount-badge">
                                        @php
                                            $discountInfo = $item['discount_info'] ?? null;
                                        @endphp
                                        @if($discountInfo && $discountInfo['type'] === 'percentage')
                                            Скидка {{ $discountInfo['percent'] }}%
                                        @elseif($discountInfo && $discountInfo['type'] === 'fixed')
                                            Скидка {{ number_format($discountInfo['amount'], 0) }} դր.
                                        @endif
                                        @if($discountInfo && isset($discountInfo['tier_name']))
                                            <span class="tier-name">({{ $discountInfo['tier_name'] }})</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="order-item-price-wrapper">
                                <div class="order-item-quantity">{{ $quantity }} шт.</div>
                                <div class="order-item-price">
                                    @if($hasDiscount)
                                        <div class="price-with-discount">
                                            <span class="current-price">{{ number_format($currentPrice, 0, '.', ' ') }} դր.</span>
                                            <span class="old-price">{{ number_format($originalPrice, 0, '.', ' ') }} դր.</span>
                                        </div>
                                        <div class="item-subtotal">
                                            {{ number_format($subtotal, 0, '.', ' ') }} դր.
                                        </div>
                                        @if($savings > 0)
                                            <div class="item-savings">
                                                экономия {{ number_format($savings, 0, '.', ' ') }} դր.
                                            </div>
                                        @endif
                                    @else
                                        <div class="regular-price">
                                            {{ number_format($currentPrice, 0, '.', ' ') }} դր.
                                        </div>
                                        <div class="item-subtotal">
                                            {{ number_format($subtotal, 0, '.', ' ') }} դր.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Сводка по скидкам -->
                @if($totalDiscount > 0)
                    <div class="order-discount-summary">
                        <div class="discount-row">
                            <span>Сумма без скидки</span>
                            <span>{{ number_format($totalOriginal, 0, '.', ' ') }} դր.</span>
                        </div>
                        <div class="discount-row savings">
                            <span>Скидка</span>
                            <span>- {{ number_format($totalDiscount, 0, '.', ' ') }} դր.</span>
                        </div>
                        @if(auth()->user() && auth()->user()->discount_tier)
                            <div class="discount-tier-info">
                                <span>Ваш уровень: {{ auth()->user()->discount_tier->name }}</span>
                                @if(auth()->user()->discount_tier->discount_percentage)
                                    <span>({{ auth()->user()->discount_tier->discount_percentage }}% скидка)</span>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Итоговая сумма -->
                <div class="order-total">
                    <span>Итого к оплате</span>
                    <div class="total-wrapper">
                        @if($totalDiscount > 0)
                            <span class="total-original">{{ number_format($totalOriginal, 0, '.', ' ') }} դր.</span>
                        @endif
                        <span class="total-final">{{ number_format($totalFinal, 0, '.', ' ') }} դր.</span>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Подтвердить заказ</button>
                <a href="{{ route('cart.index') }}" class="checkout-back">← Вернуться в корзину</a>
            </div>

        </div>
    </form>

@endsection
