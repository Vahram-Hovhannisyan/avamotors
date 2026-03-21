<div class="quick-actions">
    <a href="{{ route('admin.products') }}"        class="quick-link">Все товары</a>
    <a href="{{ route('admin.products.create') }}" class="quick-link primary">+ Добавить товар</a>
</div>

<div class="table-wrap">
    <div class="table-header">
        <span class="table-header-title">⚠️ Заканчивается (меньше 5 шт.)</span>
        <span class="table-total">{{ $stats['low_stock'] }} товаров</span>
    </div>
    <table class="data-table">
        <thead><tr><th>Название</th><th>SKU</th><th>Категория</th><th>Остаток</th><th></th></tr></thead>
        <tbody>
        @forelse($lowStock as $product)
            <tr>
                <td class="td-name">{{ $product->name }}</td>
                <td class="td-sku">{{ $product->sku }}</td>
                <td>{{ $product->category->name }}</td>
                <td><span class="badge badge-orange">{{ $product->quantity }} шт.</span></td>
                <td><a href="{{ route('admin.products.edit', $product) }}" class="action-link">Пополнить →</a></td>
            </tr>
        @empty
            <tr><td colspan="5" class="ok-cell">✓ Все товары в достаточном количестве</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <div class="table-header">
        <span class="table-header-title">🚫 Нет в наличии</span>
        <span class="table-total">{{ $stats['out_stock'] }} товаров</span>
    </div>
    <table class="data-table">
        <thead><tr><th>Название</th><th>SKU</th><th>Категория</th><th>Статус</th><th></th></tr></thead>
        <tbody>
        @forelse($outStock as $product)
            <tr>
                <td class="td-name">{{ $product->name }}</td>
                <td class="td-sku">{{ $product->sku }}</td>
                <td>{{ $product->category->name }}</td>
                <td><span class="badge badge-red">0 шт.</span></td>
                <td><a href="{{ route('admin.products.edit', $product) }}" class="action-link">Пополнить →</a></td>
            </tr>
        @empty
            <tr><td colspan="5" class="ok-cell">✓ Все товары в наличии</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
