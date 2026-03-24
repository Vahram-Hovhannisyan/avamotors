@extends('layouts.layout')

@section('title', 'Товары — Админ')

@push('styles')
    @vite(['resources/css/admin/products.css'])
@endpush

@section('content')

    <div class="page-header">
        <h1 class="page-title">Товары</h1>
        <span class="page-meta">{{ now()->format('d.m.Y') }}</span>
    </div>

    <x-flash-message />

    <div class="quick-actions">
        <a href="{{ route('admin.dashboard') }}"       class="quick-link">← Дашборд</a>
        <a href="{{ route('admin.products.create') }}" class="quick-link primary">+ Добавить товар</a>
        <a href="{{ route('admin.categories') }}"      class="quick-link">Категории</a>
        <a href="{{ route('admin.cars') }}"            class="quick-link">Марки и модели</a>
        <a href="{{ route('admin.pricing-tiers.index') }}" class="quick-link">💰 Уровни цен</a>
        <a href="{{ route('admin.engines.index') }}"   class="quick-link">🔧 Двигатели</a>
    </div>

    <form method="GET" class="toolbar">
        <div class="toolbar-search">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по названию или SKU...">
            <button type="submit">Найти</button>
        </div>
        <select name="category" class="filter-select" onchange="this.form.submit()">
            <option value="">Все категории</option>
            @foreach(App\Models\Category::flatTree() as $item)
                <option value="{{ $item['category']->id }}"
                    {{ request('category') == $item['category']->id ? 'selected' : '' }}>
                    {{ $item['depth'] > 0 ? '— ' : '' }}{{ $item['category']->name }}
                </option>
            @endforeach
        </select>
        <select name="status" class="filter-select" onchange="this.form.submit()">
            <option value="">Все статусы</option>
            <option value="active"    {{ request('status') === 'active'    ? 'selected' : '' }}>Активные</option>
            <option value="inactive"  {{ request('status') === 'inactive'  ? 'selected' : '' }}>Скрытые</option>
            <option value="low_stock" {{ request('status') === 'low_stock' ? 'selected' : '' }}>Мало на складе</option>
            <option value="out_stock" {{ request('status') === 'out_stock' ? 'selected' : '' }}>Нет в наличии</option>
        </select>
        @if(request()->hasAny(['q','category','status']))
            <a href="{{ route('admin.products') }}" class="toolbar-reset">Сбросить</a>
        @endif
    </form>

    <div class="table-wrap">
        <div class="table-header">
            <span class="table-header-title">Все товары</span>
            <span class="table-total">{{ $products->firstItem() }}–{{ $products->lastItem() }} из {{ $products->total() }} товаров</span>
        </div>
        <table class="data-table">
            <thead>
            <th>ID</th>
            <th>Название</th>
            <th>SKU</th>
            <th>Категория</th>
            <th>Бренд</th>
            <th>Цена</th>
            <th>Кол-во</th>
            <th>Статус</th>
            <th>Действия</th>
            </thead>
            <tbody>
            @forelse($products as $product)
                @php
                    $user = auth()->user();
                    $originalPrice = $product->price;
                    $finalPrice = $product->getPriceForUser($user);
                    $hasDiscount = $product->hasSpecialPriceForUser($user);
                    $discountInfo = $product->getDiscountForUser($user);
                @endphp
                <tr>
                    <td class="td-id">{{ $product->id }}</td>
                    <td class="td-name">
                        {{ $product->name }}
                        @if($hasDiscount && $discountInfo)
                            <span class="tier-badge" title="Специальная цена для {{ $discountInfo['tier_name'] }}">
                                {{ $discountInfo['tier_name'] }}
                            </span>
                            <span class="discount-badge">
                                @if($discountInfo['type'] === 'percentage')
                                    -{{ $discountInfo['percent'] }}%
                                @else
                                    -{{ number_format($discountInfo['amount'], 0) }} դր.
                                @endif
                            </span>
                        @endif
                    </td>
                    <td class="td-sku">{{ $product->sku }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->brand ?? '—' }}</td>
                    <td class="price-cell">
                        <div class="price-wrapper">
                            @if($hasDiscount)
                                <div class="price-original">{{ number_format($originalPrice, 0) }} դր.</div>
                                <div class="price-special">{{ number_format($finalPrice, 0) }} դր.</div>
                                <div class="admin-price-info">
                                    Экономия: {{ number_format($originalPrice - $finalPrice, 0) }} դր.
                                </div>
                            @else
                                <div class="price-regular">{{ number_format($originalPrice, 0) }} դր.</div>
                            @endif
                        </div>
                    </td>
                    <td>{{ $product->quantity }}</td>
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
                    <td class="td-nowrap">
                        <a href="{{ route('admin.products.edit', $product) }}" class="action-link">Ред.</a>
                        <a href="{{ route('admin.products.edit', [$product, 'tab' => 'analogs']) }}" class="action-link">Аналоги</a>
                        <form method="POST" action="{{ route('admin.products.clone', $product) }}" style="display:inline"
                              onsubmit="return confirm('Клонировать «{{ $product->name }}»?')">
                            @csrf
                            <button type="submit" class="action-link">Клон</button>
                        </form>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline"
                              onsubmit="return confirm('Удалить «{{ $product->name }}»?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="del-btn">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="empty-cell">Товары не найдены</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">{{ $products->links() }}</div>

@endsection
