@extends('layouts.layout')

@section('title', 'Заказ #' . $order->id . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/orders.css'])
@endpush

@section('content')

    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Главная</a><span>/</span>
        <a href="{{ route('orders.index') }}">Мои заказы</a><span>/</span>
        Заказ #{{ $order->id }}
    </nav>

    <div class="order-layout">

        <div>
            <div class="section-card">
                <div class="section-title">Состав заказа</div>
                <table class="items-table">
                    <thead>
                    <tr><th>Товар</th><th>Цена</th><th>Кол-во</th><th>Сумма</th></tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="item-name">{{ $item->product_name }}</div>
                                <div class="item-sku">Арт. {{ $item->product_sku }}</div>
                            </td>
                            <td>{{ $item->formattedPrice() }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="item-subtotal">{{ $item->formattedSubtotal() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="total-row">
                    <span>Итого</span>
                    <span>{{ $order->formattedTotal() }}</span>
                </div>
            </div>
        </div>

        <div>
            <div class="section-card">
                <div class="section-title">Информация о заказе</div>
                <div class="meta-row"><span class="label">Номер заказа</span><span>#{{ $order->id }}</span></div>
                <div class="meta-row">
                    <span class="label">Статус</span>
                    <span class="status-badge status-{{ $order->statusColor() }}">{{ $order->statusLabel() }}</span>
                </div>
                <div class="meta-row"><span class="label">Дата</span><span>{{ $order->created_at->format('d.m.Y H:i') }}</span></div>
            </div>

            <div class="section-card">
                <div class="section-title">Контактные данные</div>
                <div class="meta-row"><span class="label">Имя</span><span>{{ $order->name }}</span></div>
                <div class="meta-row"><span class="label">Телефон</span><span>{{ $order->phone }}</span></div>
                <div class="meta-row"><span class="label">E-mail</span><span>{{ $order->email }}</span></div>
                @if($order->address)
                    <div class="meta-row"><span class="label">Адрес</span><span>{{ $order->address }}</span></div>
                @endif
                @if($order->comment)
                    <div class="meta-row"><span class="label">Комментарий</span><span>{{ $order->comment }}</span></div>
                @endif
            </div>

            <a href="{{ route('orders.index') }}" class="back-link">← Все заказы</a>
        </div>

    </div>

@endsection
