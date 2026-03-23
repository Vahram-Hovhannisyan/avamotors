@extends('layouts.layout')

@section('title', 'Заказ оформлен — AVAMotors')

@push('styles')
    @vite(['resources/css/orders.css'])
@endpush

@section('content')

    <div class="success-wrap">
        <div class="success-card">

            <div class="success-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <h1 class="success-title">Спасибо за заказ!</h1>
            <p class="success-sub">
                Ваш заказ успешно оформлен и передан в обработку.<br>
                Мы свяжемся с вами в ближайшее время.
            </p>

            @if($orderId)
                <div class="order-number">№ {{ $orderId }}</div>
            @endif

            @if($order)
                <div class="order-details">
                    <div class="order-details-title">Детали заказа</div>
                    <div class="order-row">
                        <span class="label">Статус</span>
                        <span class="value">
                            @switch($order->status)
                                @case('pending')    Ожидает подтверждения @break
                                @case('processing') В обработке @break
                                @case('shipped')    Отправлен @break
                                @case('delivered')  Доставлен @break
                                @case('cancelled')  Отменён @break
                                @default {{ $order->status }}
                            @endswitch
                        </span>
                    </div>
                    <div class="order-row">
                        <span class="label">Товаров</span>
                        <span class="value">{{ $order->items->count() }} {{ trans_choice('позиция|позиции|позиций', $order->items->count()) }}</span>
                    </div>
                    <div class="order-row">
                        <span class="label">Дата</span>
                        <span class="value">{{ $order->created_at->format('d.m.Y') }}</span>
                    </div>
                    <div class="order-row">
                        <span class="label">Время</span>
                        <span class="value">{{ $order->created_at->format('H:i') }}</span>
                    </div>
                    <div class="order-grand-total">
                        <span class="label">Итого</span>
                        <span class="value">{{ number_format($order->total, 0, '.', ' ') }} դր.</span>
                    </div>
                </div>

                @if($order->items->count() > 0)
                    <div class="order-items-preview">
                        @foreach($order->items->take(3) as $item)
                            <div class="order-items-row">
                                <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                                <span>{{ number_format($item->price * $item->quantity, 0, '.', ' ') }} դր.</span>
                            </div>
                        @endforeach
                        @if($order->items->count() > 3)
                            <div class="order-items-more">
                                <a href="{{ route('orders.show', $order) }}">+ ещё {{ $order->items->count() - 3 }} товара</a>
                            </div>
                        @endif
                    </div>
                @endif
            @endif

            <div class="actions">
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Мои заказы</a>
                <a href="{{ route('catalog') }}" class="btn btn-outline">Продолжить покупки</a>
            </div>

            @if(!auth()->check())
                <p class="guest-note">
                    Сохраните номер заказа для отслеживания.<br>
                    <a href="{{ route('register') }}">Зарегистрируйтесь</a>,
                    чтобы видеть все заказы в личном кабинете.
                </p>
            @endif

        </div>
    </div>

@endsection
