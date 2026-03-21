@extends('layouts.layout')

@section('title', 'Мои заказы — AVAMotors')

@push('styles')
    @vite(['resources/css/orders.css'])
@endpush

@section('content')

    <h1 class="page-title">Мои заказы</h1>

    @if($orders->isEmpty())
        <div class="empty-orders">
            <div class="empty-orders-icon">📦</div>
            <strong>У вас пока нет заказов</strong>
            <p>Оформите первый заказ в нашем каталоге</p>
            <a href="{{ route('catalog') }}" class="orders-catalog-btn">Перейти в каталог</a>
        </div>
    @else
        <div class="orders-list">
            @foreach($orders as $order)
                <a href="{{ route('orders.show', $order) }}" class="order-card">

                    <div class="order-card-header">
                        <div class="order-card-left">
                            <span class="order-card-id">Заказ #{{ $order->id }}</span>
                            <span class="order-card-date">{{ $order->created_at->format('d.m.Y, H:i') }}</span>
                        </div>
                        <div class="order-card-right">
                            <span class="status-badge status-{{ $order->statusColor() }}">{{ $order->statusLabel() }}</span>
                            <span class="order-card-total">{{ $order->formattedTotal() }}</span>
                        </div>
                    </div>

                    <div class="order-card-items">
                        @foreach($order->items->take(3) as $item)
                            <div class="order-card-item">
                                <span class="order-card-item-name">{{ Str::limit($item->product_name, 60) }}</span>
                                <span class="order-card-item-meta">{{ $item->quantity }} шт. · {{ $item->formattedSubtotal() }}</span>
                            </div>
                        @endforeach
                        @if($order->items->count() > 3)
                            <div class="order-card-more">
                                + ещё {{ $order->items->count() - 3 }} {{ trans_choice('товар|товара|товаров', $order->items->count() - 3) }}
                            </div>
                        @endif
                    </div>

                </a>
            @endforeach
        </div>

        <div class="pagination-wrap">{{ $orders->links() }}</div>
    @endif

@endsection
