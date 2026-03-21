@extends('layouts.layout')

@section('title', 'Заказ #' . $order->id . ' — Админ')

@push('styles')
    @vite(['resources/css/admin/orders.css'])
@endpush

@section('content')

    <div class="page-header">
        <div>
            <h1 class="page-title">Заказ #{{ $order->id }}</h1>
            <div class="page-sub">{{ $order->created_at->format('d.m.Y в H:i') }}</div>
        </div>
        <span class="badge badge-lg badge-{{ $order->statusColor() }}">{{ $order->statusLabel() }}</span>
    </div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <div class="quick-actions">
        <a href="{{ route('admin.orders') }}" class="quick-link">← Все заказы</a>
        <a href="{{ route('admin.dashboard', ['tab' => 'orders']) }}" class="quick-link">Дашборд</a>
        <a href="{{ route('admin.orders.invoice.preview', $order) }}" target="_blank" class="quick-link">👁 Просмотр PDF</a>
        <a href="{{ route('admin.orders.invoice.download', $order) }}" class="quick-link-pdf">⬇ Скачать PDF</a>
    </div>

    <div class="order-layout">

        {{-- ── LEFT COLUMN ── --}}
        <div>

            {{-- Items --}}
            <div class="section-card">
                <div class="section-title">Состав заказа ({{ $order->items->count() }} поз.)</div>
                <table class="items-table">
                    <thead>
                    <tr><th>Товар</th><th>Цена</th><th>Кол-во</th><th>Сумма</th></tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="item-name">{{ $item->product_name }}</div>
                                <div class="item-sku">{{ $item->product_sku }}</div>
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

            {{-- Customer --}}
            <div class="section-card">
                <div class="section-title">Данные покупателя</div>
                <div class="meta-row"><span class="label">Имя</span><span>{{ $order->name }}</span></div>
                <div class="meta-row"><span class="label">Телефон</span><span>{{ $order->phone }}</span></div>
                <div class="meta-row"><span class="label">E-mail</span><span>{{ $order->email }}</span></div>
                @if($order->address)
                    <div class="meta-row"><span class="label">Адрес</span><span>{{ $order->address }}</span></div>
                @endif
                @if($order->comment)
                    <div class="meta-row"><span class="label">Комментарий</span><span>{{ $order->comment }}</span></div>
                @endif
                @if($order->user)
                    <div class="meta-row">
                        <span class="label">Аккаунт</span>
                        <span class="brand">{{ $order->user->email }}</span>
                    </div>
                @endif
            </div>

        </div>

        {{-- ── RIGHT COLUMN ── --}}
        <div>

            {{-- Status form --}}
            <div class="section-card">
                <div class="section-title">Изменить статус</div>
                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf @method('PATCH')
                    <select name="status" class="status-select">
                        @foreach(\App\Models\Order::STATUSES as $key => $label)
                            <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="status-btn">Сохранить статус</button>
                </form>
            </div>

            {{-- Timeline --}}
            <div class="section-card">
                <div class="section-title">Прогресс</div>
                @php
                    $steps = ['pending', 'confirmed', 'shipped', 'delivered'];
                    $currentIndex = array_search($order->status, $steps);
                @endphp
                <div class="timeline">
                    @foreach($steps as $i => $step)
                        @php
                            $isDone   = $currentIndex !== false && $i < $currentIndex;
                            $isActive = $order->status === $step;
                        @endphp
                        <div class="timeline-step {{ $isDone ? 'done' : ($isActive ? 'active' : '') }}">
                            <div class="timeline-dot"></div>
                            <span class="timeline-label">{{ \App\Models\Order::STATUSES[$step] }}</span>
                        </div>
                    @endforeach
                    @if($order->status === 'cancelled')
                        <div class="timeline-step cancelled">
                            <div class="timeline-dot"></div>
                            <span class="timeline-label">Отменён</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

@endsection
