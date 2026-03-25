@extends('layouts.layout')

@section('title', 'Панель управления — AVAMotors')

@push('styles')
    @vite(['resources/css/admin/dashboard.css'])
@endpush

@section('content')

    <div class="admin-header">
        <h1 class="admin-title">Панель управления</h1>
        <span class="admin-date">{{ now()->format('d.m.Y, H:i') }}</span>
    </div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <div class="stats-grid">
        <a href="{{ route('admin.products') }}" class="stat-card">
            <div class="stat-label">Товаров</div>
            <div class="stat-value">{{ $stats['products'] }}</div>
        </a>
        <a href="{{ route('admin.users') }}" class="stat-card">
            <div class="stat-label">Покупателей</div>
            <div class="stat-value">{{ $stats['users'] }}</div>
        </a>
        <a href="{{ route('admin.orders') }}" class="stat-card">
            <div class="stat-label">Всего заказов</div>
            <div class="stat-value">{{ $stats['orders'] }}</div>
        </a>
        <a href="{{ route('admin.orders', ['status' => 'pending']) }}" class="stat-card">
            <div class="stat-label">Новых заказов</div>
            <div class="stat-value">{{ $stats['new_orders'] }}</div>
        </a>
        <a href="{{ route('admin.products') }}" class="stat-card">
            <div class="stat-label">Мало на складе</div>
            <div class="stat-value">{{ $stats['low_stock'] }}</div>
        </a>
        <a href="{{ route('admin.products') }}" class="stat-card">
            <div class="stat-label">Нет в наличии</div>
            <div class="stat-value">{{ $stats['out_stock'] }}</div>
        </a>
        <a href="{{ route('admin.pricing-tiers.index') }}" class="stat-card">
            <div class="stat-label">Уровни ценообразования</div>
            <div class="stat-value">{{ $stats['pricing_tiers_count'] ?? 0 }}</div>
        </a>
    </div>

    {{-- Pricing Tiers Statistics --}}
    @if(isset($pricingStats) && $pricingStats['total_tiers'] > 0)
        <div class="pricing-stats">
            <div class="pricing-stats-header">
                <div class="pricing-stats-title">
                    🎯 Статистика ценообразования
                </div>
                <a href="{{ route('admin.pricing-tiers.index') }}" style="font-size: 13px; color: #3b82f6;">
                    Управление уровнями →
                </a>
            </div>
            <div class="pricing-stats-grid">
                <div class="pricing-stat-card">
                    <div class="pricing-stat-label">Всего уровней</div>
                    <div class="pricing-stat-value">{{ $pricingStats['total_tiers'] }}</div>
                    <div class="pricing-stat-sub">
                        Активных: {{ $pricingStats['active_tiers'] }}
                    </div>
                </div>
                <div class="pricing-stat-card">
                    <div class="pricing-stat-label">Пользователи с tier</div>
                    <div class="pricing-stat-value">{{ $pricingStats['users_with_tiers'] }}</div>
                    <div class="pricing-stat-sub">
                        {{ $pricingStats['users_percentage'] }}% от всех пользователей
                    </div>
                </div>
                <div class="pricing-stat-card">
                    <div class="pricing-stat-label">Товары со скидкой*</div>
                    <div class="pricing-stat-value">{{ $pricingStats['products_with_discount'] }}</div>
                    <div class="discount-stat">
                        Для текущего администратора
                    </div>
                </div>
                <div class="pricing-stat-card">
                    <div class="pricing-stat-label">Средняя скидка</div>
                    <div class="pricing-stat-value">
                        @if($pricingStats['average_discount_percent'] > 0)
                            {{ $pricingStats['average_discount_percent'] }}%
                        @else
                            —
                        @endif
                    </div>
                    <div class="pricing-stat-sub">
                        По всем активным уровням
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="tabs">
        <button class="tab-btn active" data-tab="products">
            📦 Товары <span class="tab-badge muted">{{ $stats['products'] }}</span>
        </button>
        <button class="tab-btn" data-tab="orders">
            🛒 Заказы
            @if($stats['new_orders'] > 0)
                <span class="tab-badge warn">{{ $stats['new_orders'] }} новых</span>
            @else
                <span class="tab-badge muted">{{ $stats['orders'] }}</span>
            @endif
        </button>
        <button class="tab-btn" data-tab="lowstock">
            ⚠️ Склад
            @if($stats['out_stock'] > 0)
                <span class="tab-badge danger">{{ $stats['out_stock'] }}</span>
            @else
                <span class="tab-badge muted">{{ $stats['low_stock'] }}</span>
            @endif
        </button>
        <button class="tab-btn" data-tab="users">
            👤 Пользователи <span class="tab-badge muted">{{ $stats['users'] }}</span>
        </button>
        <button class="tab-btn" data-tab="analogs">
            🔄 Аналоги <span class="tab-badge muted">{{ $totalAnalogs }}</span>
        </button>
        <button class="tab-btn" data-tab="analytics">
            📊 Аналитика
        </button>
    </div>

    <div id="tab-products" class="tab-panel active">
        @include('admin.dashboard.tab-products')
    </div>

    <div id="tab-orders" class="tab-panel">
        @include('admin.dashboard.tab-orders')
    </div>

    <div id="tab-lowstock" class="tab-panel">
        @include('admin.dashboard.tab-lowstock')
    </div>

    <div id="tab-users" class="tab-panel">
        @include('admin.dashboard.tab-users')
    </div>

    <div id="tab-analogs" class="tab-panel">
        @include('admin.dashboard.tab-analogs')
    </div>

    <div id="tab-analytics" class="tab-panel">
        @include('admin.dashboard.tab-analytics')
    </div>


@endsection

@push('scripts')
    @vite(['resources/js/admin/dashboard.js'])
@endpush
