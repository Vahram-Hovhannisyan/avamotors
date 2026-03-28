@extends('layouts.layout')

@section('title', __('admin.dashboard.title') . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/admin/dashboard.css'])
@endpush

@section('content')

    <div class="admin-header">
        <h1 class="admin-title">{{ __('admin.dashboard.title') }}</h1>
        <span class="admin-date">{{ now()->format('d.m.Y, H:i') }}</span>
    </div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <div class="stats-grid">
        <a href="{{ route('admin.products') }}" class="stat-card">
            <div class="stat-label">{{ __('admin.dashboard.stats.products') }}</div>
            <div class="stat-value">{{ $stats['products'] }}</div>
        </a>
        <a href="{{ route('admin.users') }}" class="stat-card">
            <div class="stat-label">{{ __('admin.dashboard.stats.customers') }}</div>
            <div class="stat-value">{{ $stats['users'] }}</div>
        </a>
        <a href="{{ route('admin.orders') }}" class="stat-card">
            <div class="stat-label">{{ __('admin.dashboard.stats.total_orders') }}</div>
            <div class="stat-value">{{ $stats['orders'] }}</div>
        </a>
        <a href="{{ route('admin.orders', ['status' => 'pending']) }}" class="stat-card">
            <div class="stat-label">{{ __('admin.dashboard.stats.new_orders') }}</div>
            <div class="stat-value">{{ $stats['new_orders'] }}</div>
        </a>
        <a href="{{ route('admin.products') }}" class="stat-card">
            <div class="stat-label">{{ __('admin.dashboard.stats.low_stock') }}</div>
            <div class="stat-value">{{ $stats['low_stock'] }}</div>
        </a>
        <a href="{{ route('admin.products') }}" class="stat-card">
            <div class="stat-label">{{ __('admin.dashboard.stats.out_of_stock') }}</div>
            <div class="stat-value">{{ $stats['out_stock'] }}</div>
        </a>
        <a href="{{ route('admin.pricing-tiers.index') }}" class="stat-card">
            <div class="stat-label">{{ __('admin.dashboard.stats.pricing_tiers') }}</div>
            <div class="stat-value">{{ $stats['pricing_tiers_count'] ?? 0 }}</div>
        </a>
    </div>

    {{-- Pricing Tiers Statistics --}}
    @if(isset($pricingStats) && $pricingStats['total_tiers'] > 0)
        <div class="pricing-stats">
            <div class="pricing-stats-header">
                <div class="pricing-stats-title">
                    🎯 {{ __('admin.dashboard.pricing_stats.title') }}
                </div>
                <a href="{{ route('admin.pricing-tiers.index') }}" style="font-size: 13px; color: #3b82f6;">
                    {{ __('admin.dashboard.pricing_stats.manage') }} →
                </a>
            </div>
            <div class="pricing-stats-grid">
                <div class="pricing-stat-card">
                    <div class="pricing-stat-label">{{ __('admin.dashboard.pricing_stats.total_tiers') }}</div>
                    <div class="pricing-stat-value">{{ $pricingStats['total_tiers'] }}</div>
                    <div class="pricing-stat-sub">
                        {{ __('admin.dashboard.pricing_stats.active') }}: {{ $pricingStats['active_tiers'] }}
                    </div>
                </div>
                <div class="pricing-stat-card">
                    <div class="pricing-stat-label">{{ __('admin.dashboard.pricing_stats.users_with_tiers') }}</div>
                    <div class="pricing-stat-value">{{ $pricingStats['users_with_tiers'] }}</div>
                    <div class="pricing-stat-sub">
                        {{ $pricingStats['users_percentage'] }}% {{ __('admin.dashboard.pricing_stats.of_all_users') }}
                    </div>
                </div>
                <div class="pricing-stat-card">
                    <div class="pricing-stat-label">{{ __('admin.dashboard.pricing_stats.products_with_discount') }}</div>
                    <div class="pricing-stat-value">{{ $pricingStats['products_with_discount'] }}</div>
                    <div class="discount-stat">
                        {{ __('admin.dashboard.pricing_stats.for_current_admin') }}
                    </div>
                </div>
                <div class="pricing-stat-card">
                    <div class="pricing-stat-label">{{ __('admin.dashboard.pricing_stats.avg_discount') }}</div>
                    <div class="pricing-stat-value">
                        @if($pricingStats['average_discount_percent'] > 0)
                            {{ $pricingStats['average_discount_percent'] }}%
                        @else
                            —
                        @endif
                    </div>
                    <div class="pricing-stat-sub">
                        {{ __('admin.dashboard.pricing_stats.across_active_tiers') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="tabs">
        <button class="tab-btn active" data-tab="products">
            📦 {{ __('admin.dashboard.tabs.products') }} <span class="tab-badge muted">{{ $stats['products'] }}</span>
        </button>
        <button class="tab-btn" data-tab="orders">
            🛒 {{ __('admin.dashboard.tabs.orders') }}
            @if($stats['new_orders'] > 0)
                <span class="tab-badge warn">{{ $stats['new_orders'] }} {{ __('admin.dashboard.tabs.new') }}</span>
            @else
                <span class="tab-badge muted">{{ $stats['orders'] }}</span>
            @endif
        </button>
        <button class="tab-btn" data-tab="lowstock">
            ⚠️ {{ __('admin.dashboard.tabs.stock') }}
            @if($stats['out_stock'] > 0)
                <span class="tab-badge danger">{{ $stats['out_stock'] }}</span>
            @else
                <span class="tab-badge muted">{{ $stats['low_stock'] }}</span>
            @endif
        </button>
        <button class="tab-btn" data-tab="users">
            👤 {{ __('admin.dashboard.tabs.users') }} <span class="tab-badge muted">{{ $stats['users'] }}</span>
        </button>
        <button class="tab-btn" data-tab="analogs">
            🔄 {{ __('admin.dashboard.tabs.analogs') }} <span class="tab-badge muted">{{ $totalAnalogs }}</span>
        </button>
        <button class="tab-btn" data-tab="analytics">
            📊 {{ __('admin.dashboard.tabs.analytics') }}
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
