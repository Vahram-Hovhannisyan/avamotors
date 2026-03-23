<div class="quick-actions">
    <a href="{{ route('admin.products.create') }}" class="quick-link primary">+ Добавить товар</a>
    <a href="{{ route('admin.products') }}"        class="quick-link">Все товары</a>
    <a href="{{ route('admin.categories') }}"      class="quick-link">Категории</a>
    <a href="{{ route('admin.cars') }}"            class="quick-link">Марки и модели</a>
    <a href="{{ route('admin.analogs') }}"         class="quick-link">Справочник аналогов</a>
    <a href="{{ route('admin.pricing-tiers.index') }}" class="quick-link">Уровни цен</a>
</div>

<div class="table-wrap">
    <div class="table-header">
        <span class="table-header-title">Последние товары</span>
        <a href="{{ route('admin.products') }}" class="table-header-link">Все товары →</a>
    </div>

    <table class="data-table">
        <thead>
        <th>Название</th>
        <th>SKU</th>
        <th>Категория</th>
        <th>Цена</th>
        <th>Остаток</th>
        <th>Статус</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($recent as $product)
            @php
                $user = auth()->user();
                $originalPrice = $product->price;
                $finalPrice = $product->getPriceForUser($user);
                $hasDiscount = $product->hasSpecialPriceForUser($user);
                $discountInfo = $product->getDiscountForUser($user);
            @endphp
            <tr>
                <td class="td-name">
                    <div class="product-name-wrapper">
                        {{ $product->name }}
                        @if($hasDiscount && $discountInfo)
                            <span class="tier-badge-dash" title="Специальная цена для {{ $discountInfo['tier_name'] }}">
                                {{ $discountInfo['tier_name'] }}
                            </span>
                            <span class="discount-badge-dash">
                                @if($discountInfo['type'] === 'percentage')
                                    -{{ $discountInfo['percent'] }}%
                                @else
                                    -{{ number_format($discountInfo['amount'], 0) }} դր.
                                @endif
                            </span>
                        @endif
                    </div>
                </td>
                <td class="td-sku">{{ $product->sku }}</td>
                <td>{{ $product->category->name }}</td>
                <td>
                    <div class="price-wrapper-dash">
                        @if($hasDiscount)
                            <div class="price-original-dash">{{ number_format($originalPrice, 0) }} դր.</div>
                            <div class="price-special-dash">{{ number_format($finalPrice, 0) }} դր.</div>
                            <div style="font-size: 0.6rem; color: #6b7280;">
                                эконом. {{ number_format($originalPrice - $finalPrice, 0) }} դր.
                            </div>
                        @else
                            <div class="price-regular-dash">{{ number_format($originalPrice, 0) }} դր.</div>
                        @endif
                    </div>
                </td>
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
