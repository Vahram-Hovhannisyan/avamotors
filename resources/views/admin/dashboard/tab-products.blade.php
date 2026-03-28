<div class="quick-actions">
    <a href="{{ route('admin.products.create') }}" class="quick-link primary">+ {{ __('admin.products.add_product') }}</a>
    <a href="{{ route('admin.products') }}"        class="quick-link">{{ __('admin.products.all_products') }}</a>
    <a href="{{ route('admin.categories') }}"      class="quick-link">{{ __('admin.products.categories') }}</a>
    <a href="{{ route('admin.cars') }}"            class="quick-link">{{ __('admin.products.car_brands_models') }}</a>
    <a href="{{ route('admin.analogs') }}"         class="quick-link">{{ __('admin.products.analogs_directory') }}</a>
    <a href="{{ route('admin.pricing-tiers.index') }}" class="quick-link">{{ __('admin.products.pricing_tiers') }}</a>
</div>

<div class="table-wrap">
    <div class="table-header">
        <span class="table-header-title">{{ __('admin.products.recent_products') }}</span>
        <a href="{{ route('admin.products') }}" class="table-header-link">{{ __('admin.products.view_all') }} →</a>
    </div>

    <table class="data-table">
        <thead>
        <tr>
            <th>{{ __('admin.products.table.name') }}</th>
            <th>{{ __('admin.products.table.sku') }}</th>
            <th>{{ __('admin.products.table.category') }}</th>
            <th>{{ __('admin.products.table.price') }}</th>
            <th>{{ __('admin.products.table.stock') }}</th>
            <th>{{ __('admin.products.table.status') }}</th>
            <th></th>
        </tr>
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
                            <span class="tier-badge-dash" title="{{ __('admin.products.table.special_price_for', ['tier' => $discountInfo['tier_name']]) }}">
                                {{ $discountInfo['tier_name'] }}
                            </span>
                            <span class="discount-badge-dash">
                                @if($discountInfo['type'] === 'percentage')
                                    -{{ $discountInfo['percent'] }}%
                                @else
                                    -{{ number_format($discountInfo['amount'], 0) }} {{ __('admin.products.currency') }}
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
                            <div class="price-original-dash">{{ number_format($originalPrice, 0) }} {{ __('admin.products.currency') }}</div>
                            <div class="price-special-dash">{{ number_format($finalPrice, 0) }} {{ __('admin.products.currency') }}</div>
                            <div style="font-size: 0.6rem; color: #6b7280;">
                                {{ __('admin.products.table.savings') }} {{ number_format($originalPrice - $finalPrice, 0) }} {{ __('admin.products.currency') }}
                            </div>
                        @else
                            <div class="price-regular-dash">{{ number_format($originalPrice, 0) }} {{ __('admin.products.currency') }}</div>
                        @endif
                    </div>
                </td>
                <td>{{ $product->quantity }} {{ __('admin.products.table.pcs') }}</td>
                <td>
                    @if(!$product->is_active)
                        <span class="badge badge-orange">{{ __('admin.products.status.hidden') }}</span>
                    @elseif($product->quantity === 0)
                        <span class="badge badge-red">{{ __('admin.products.status.out_of_stock') }}</span>
                    @elseif($product->quantity < 5)
                        <span class="badge badge-orange">{{ __('admin.products.status.low_stock') }}</span>
                    @else
                        <span class="badge badge-green">{{ __('admin.products.status.in_stock') }}</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" class="action-link">{{ __('admin.products.table.edit') }}</a>
                    <a href="{{ route('admin.products.edit', [$product, 'tab' => 'analogs']) }}" class="action-link">{{ __('admin.products.table.analogs') }}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
