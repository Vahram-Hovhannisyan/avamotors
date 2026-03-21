<div class="quick-actions">
    <a href="{{ route('admin.orders') }}"                            class="quick-link">Все заказы</a>
    <a href="{{ route('admin.orders', ['status' => 'pending']) }}"   class="quick-link">Новые</a>
    <a href="{{ route('admin.orders', ['status' => 'confirmed']) }}" class="quick-link">Подтверждённые</a>
    <a href="{{ route('admin.orders', ['status' => 'shipped']) }}"   class="quick-link">Отправленные</a>
</div>
<div class="table-wrap">
    <div class="table-header">
        <span class="table-header-title">Последние заказы</span>
        <a href="{{ route('admin.orders') }}" class="table-header-link">Все заказы →</a>
    </div>
    <table class="data-table">
        <thead>
        <tr><th>#</th><th>Покупатель</th><th>Телефон</th><th>Товаров</th><th>Сумма</th><th>Статус</th><th>Дата</th><th></th></tr>
        </thead>
        <tbody>
        @forelse($recentOrders as $order)
            <tr>
                <td class="td-id">#{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td class="td-muted">{{ $order->phone }}</td>
                <td>{{ $order->items_count }}</td>
                <td class="td-total">{{ $order->formattedTotal() }}</td>
                <td><span class="badge badge-{{ $order->statusColor() }}">{{ $order->statusLabel() }}</span></td>
                <td class="td-date">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td><a href="{{ route('admin.orders.show', $order) }}" class="action-link">Открыть →</a></td>
            </tr>
        @empty
            <tr><td colspan="8" class="empty-cell">Заказов пока нет</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
