<div class="quick-actions">
    <a href="{{ route('admin.products.create') }}" class="quick-link primary">+ Добавить товар</a>
    <a href="{{ route('admin.products') }}"        class="quick-link">Все товары</a>
    <a href="{{ route('admin.categories') }}"      class="quick-link">Категории</a>
    <a href="{{ route('admin.cars') }}"            class="quick-link">Марки и модели</a>
    <a href="{{ route('admin.analogs') }}"         class="quick-link">Справочник аналогов</a>
</div>
<div class="table-wrap">
    <div class="table-header">
        <span class="table-header-title">Последние товары</span>
        <a href="{{ route('admin.products') }}" class="table-header-link">Все товары →</a>
    </div>
    <table class="data-table">
        <thead>
        <tr><th>Название</th><th>SKU</th><th>Категория</th><th>Цена</th><th>Остаток</th><th>Статус</th><th></th></tr>
        </thead>
        <tbody>
        @foreach($recent as $product)
            <tr>
                <td class="td-name">{{ $product->name }}</td>
                <td class="td-sku">{{ $product->sku }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->formattedPrice() }}</td>
                <td>{{ $product->quantity }} шт.</td>
                <td>
                    @if(!$product->is_active)
                        <span class="badge badge-orange">Скрыт</span>
                    @elseif($product->quantity === 0)
                        <span class="badge badge-red">Нет</span>
                    @elseif($product->quantity < 5)
                        <span class="badge badge-orange">Мало</span>
                    @else
                        <span class="badge badge-green">В наличии</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" class="action-link">Ред.</a>
                    <a href="{{ route('admin.products.edit', [$product, 'tab' => 'analogs']) }}" class="action-link">Аналоги</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
