@extends('layouts.layout')

@section('title', 'Корзина — AVAMotors')

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
    @if($errors->any())
        <div class="flash-warning">
            <strong>Пожалуйста, исправьте ошибки:</strong>
            <ul>
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <h1 class="page-title">Корзина</h1>

    @if(empty($items))
        <div class="empty-cart">
            <strong>Корзина пуста</strong>
            <p>Добавьте товары из каталога</p>
            <a href="{{ route('catalog') }}" class="checkout-btn inline">Перейти в каталог</a>
        </div>
    @else
        <div class="cart-layout">

            <div>
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead>
                        <tr>
                            <th>Товар</th><th>Цена</th><th>Кол-во</th><th>Сумма</th><th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            @php $product = $item['product']; @endphp
                            @if($product)
                                <tr>
                                    <td>
                                        <div class="cart-product-name">{{ $product->name }}</div>
                                        <div class="cart-product-sku">Арт. {{ $product->sku }}</div>
                                    </td>
                                    <td>{{ number_format($product->price, 0, '.', ' ') }} դր.</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.update') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="number" name="quantity" class="qty-input"
                                                   value="{{ $item['quantity'] }}" min="1"
                                                   max="{{ $product->quantity }}"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="cart-subtotal">
                                        {{ number_format($product->price * $item['quantity'], 0, '.', ' ') }} դր.
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="remove-btn">✕ Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="cart-clear">
                    <form method="POST" action="{{ route('cart.clear') }}">
                        @csrf
                        <button type="submit" class="remove-btn"
                                onclick="return confirm('Очистить корзину?')">Очистить корзину</button>
                    </form>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-title">Итого</div>
                @foreach($items as $item)
                    @if($item['product'])
                        <div class="summary-row">
                            <span class="label">{{ Str::limit($item['product']->name, 28) }}</span>
                            <span>{{ $item['quantity'] }} × {{ number_format($item['product']->price, 0, '.', ' ') }} դր.</span>
                        </div>
                    @endif
                @endforeach
                <div class="summary-total">
                    <span>К оплате</span>
                    <span>{{ number_format($total, 0, '.', ' ') }} դր.</span>
                </div>
                @auth
                    <a href="{{ route('orders.checkout') }}" class="checkout-btn">Оформить заказ</a>
                @else
                    <a href="{{ route('login') }}" class="checkout-btn">Войти для оформления</a>
                @endauth
            </div>

        </div>
    @endif

@endsection
