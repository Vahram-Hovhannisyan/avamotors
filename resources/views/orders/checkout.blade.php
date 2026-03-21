@extends('layouts.layout')

@section('title', 'Оформление заказа — AVAMotors')

@push('styles')
    @vite(['resources/css/orders-front.css'])
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
                @foreach($items as $item)
                    @php $product = $item['product']; @endphp
                    @if($product)
                        <div class="order-item">
                            <div>
                                <div class="order-item-name">{{ $product->name }}</div>
                                <div class="order-item-sku">{{ $product->sku }} × {{ $item['quantity'] }}</div>
                            </div>
                            <div class="order-item-price">
                                {{ number_format($product->price * $item['quantity'], 0, '.', ' ') }} դր.
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="order-total">
                    <span>Итого</span>
                    <span>{{ number_format($total, 0, '.', ' ') }} դր.</span>
                </div>
                <button type="submit" class="submit-btn">Подтвердить заказ</button>
                <a href="{{ route('cart.index') }}" class="checkout-back">← Вернуться в корзину</a>
            </div>

        </div>
    </form>

@endsection
