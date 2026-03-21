@extends('layouts.layout')

@section('title', 'Заказы — Админ')

@push('styles')
    @vite(['resources/css/admin/orders.css'])
@endpush

@section('content')

    <div class="page-header">
        <h1 class="page-title">Заказы</h1>
        <span class="page-meta">{{ now()->format('d.m.Y') }}</span>
    </div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <div class="quick-actions">
        <a href="{{ route('admin.dashboard') }}" class="quick-link">← Дашборд</a>
    </div>

    <div class="status-tabs">
        <a href="{{ route('admin.orders') }}"
           class="status-tab {{ !request('status') ? 'active' : '' }}">Все</a>
        @foreach(\App\Models\Order::STATUSES as $key => $label)
            <a href="{{ route('admin.orders', ['status' => $key]) }}"
               class="status-tab {{ request('status') === $key ? 'active' : '' }}">{{ $label }}</a>
        @endforeach
    </div>

    <form method="GET" class="toolbar">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        <div class="toolbar-search">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Имя, телефон, email, номер...">
            <button type="submit">Найти</button>
        </div>
        @if(request('q'))
            <a href="{{ route('admin.orders', array_filter(['status' => request('status')])) }}" class="toolbar-reset">Сбросить</a>
        @endif
    </form>

    <div class="table-wrap">
        <div class="table-header">
            <span class="table-header-title">Все заказы</span>
            <span class="table-total">{{ $orders->total() }} заказов</span>
        </div>
        <table class="data-table">
            <thead>
            <tr>
                <th>#</th><th>Покупатель</th><th>Контакт</th>
                <th>Товаров</th><th>Сумма</th><th>Статус</th><th>Дата</th><th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td class="td-order-id">#{{ $order->id }}</td>
                    <td>
                        <div class="td-customer-name">{{ $order->name }}</div>
                        @if($order->user)
                            <div class="td-customer-email">{{ $order->user->email }}</div>
                        @endif
                    </td>
                    <td class="td-muted">{{ $order->phone }}</td>
                    <td>{{ $order->items_count }}</td>
                    <td class="td-total">{{ $order->formattedTotal() }}</td>
                    <td><span class="badge badge-{{ $order->statusColor() }}">{{ $order->statusLabel() }}</span></td>
                    <td class="td-date">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td><a href="{{ route('admin.orders.show', $order) }}" class="action-link">Открыть →</a></td>
                </tr>
            @empty
                <tr><td colspan="8" class="empty-cell">Заказы не найдены</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">{{ $orders->links() }}</div>

@endsection
