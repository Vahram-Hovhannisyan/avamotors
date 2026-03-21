{{-- Период --}}
<div class="quick-actions">
    @foreach([7 => '7 дней', 30 => '30 дней', 90 => '90 дней'] as $days => $label)
        <a href="{{ request()->fullUrlWithQuery(['tab' => 'analytics', 'period' => $days]) }}"
           class="quick-link {{ $period == $days ? 'primary' : '' }}">
            {{ $label }}
        </a>
    @endforeach
</div>

{{-- Сводка --}}
<div class="analytics-summary">
    <div class="analytics-stat">
        <div class="analytics-stat-label">Выручка за период</div>
        <div class="analytics-stat-value">{{ number_format($totalRevenue, 0, '.', ' ') }} դր.</div>
    </div>
    <div class="analytics-stat">
        <div class="analytics-stat-label">Заказов</div>
        <div class="analytics-stat-value">{{ $totalOrders }}</div>
    </div>
    <div class="analytics-stat">
        <div class="analytics-stat-label">Средний чек</div>
        <div class="analytics-stat-value">{{ number_format($avgOrder, 0, '.', ' ') }} դր.</div>
    </div>
    <div class="analytics-stat">
        <div class="analytics-stat-label">За день (среднее)</div>
        <div class="analytics-stat-value">{{ $period > 0 ? number_format($totalRevenue / $period, 0, '.', ' ') : 0 }} դր.</div>
    </div>
</div>

{{-- График выручки --}}
<div class="table-wrap" style="margin-bottom:1.5rem;">
    <div class="table-header">
        <span class="table-header-title">Выручка по дням</span>
        <span class="table-total">за {{ $period }} дней</span>
    </div>
    <div class="analytics-chart-wrap">
        @php
            $maxRevenue = collect($revenueDays)->max('revenue') ?: 1;
        @endphp
        <div class="analytics-chart">
            @foreach($revenueDays as $day)
                @php $pct = round(($day['revenue'] / $maxRevenue) * 100); @endphp
                <div class="chart-bar-wrap" title="{{ $day['date'] }}: {{ number_format($day['revenue'], 0, '.', ' ') }} դր.">
                    <div class="chart-bar" style="height: {{ max($pct, $day['revenue'] > 0 ? 2 : 0) }}%"></div>
                    @if(count($revenueDays) <= 14)
                        <div class="chart-label">{{ $day['date'] }}</div>
                    @endif
                </div>
            @endforeach
        </div>
        @if(count($revenueDays) > 14)
            <div class="chart-x-labels">
                <span>{{ $revenueDays[0]['date'] }}</span>
                <span>{{ $revenueDays[count($revenueDays) - 1]['date'] }}</span>
            </div>
        @endif
    </div>
</div>

{{-- Топ товаров --}}
<div class="table-wrap">
    <div class="table-header">
        <span class="table-header-title">Топ товаров по продажам</span>
        <span class="table-total">за {{ $period }} дней</span>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Товар</th>
                <th>SKU</th>
                <th>Продано (шт.)</th>
                <th>Заказов</th>
                <th>Выручка</th>
            </tr>
        </thead>
        <tbody>
        @forelse($topProducts as $i => $product)
            <tr>
                <td class="td-muted">{{ $i + 1 }}</td>
                <td class="td-name">{{ $product->product_name }}</td>
                <td class="td-sku">{{ $product->product_sku }}</td>
                <td><strong>{{ $product->total_qty }}</strong></td>
                <td class="td-muted">{{ $product->order_count }}</td>
                <td class="td-total">{{ number_format($product->total_revenue, 0, '.', ' ') }} դր.</td>
            </tr>
        @empty
            <tr><td colspan="6" class="empty-cell">Нет данных за выбранный период</td></tr>
        @endforelse
        </tbody>
    </table>
</div>