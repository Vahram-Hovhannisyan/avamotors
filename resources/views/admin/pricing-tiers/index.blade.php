@extends('layouts.layout')

@section('title', 'Pricing Tiers — AVAMotors')

@push('styles')
    @vite(['resources/css/admin/pricing-tiers.css'])
@endpush

@section('content')
    <div class="pricing-tiers-container">
        <div class="pricing-tiers-header">
            <h1 class="pricing-tiers-title">Уровни ценообразования</h1>
            <a href="{{ route('admin.pricing-tiers.create') }}" class="btn-create">
                + Создать новый уровен
            </a>
        </div>

        @if(session('success'))
            <div class="flash-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="flash-error">{{ session('error') }}</div>
        @endif

        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Поиск по названию..."
                   value="{{ request('search') }}" class="search-input">
            <select name="type" class="filter-select filter-auto-submit">
                <option value="">Все типы</option>
                <option value="percentage" {{ request('type') == 'percentage' ? 'selected' : '' }}>Процент</option>
                <option value="fixed" {{ request('type') == 'fixed' ? 'selected' : '' }}>Фиксированная сумма</option>
            </select>
            <select name="status" class="filter-select filter-auto-submit">
                <option value="">Все статусы</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Активные</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Неактивные</option>
            </select>
            <button type="submit" class="btn-filter">Фильтр</button>
            <a href="{{ route('admin.pricing-tiers.index') }}" class="btn-filter">Сбросить</a>
        </form>

        <table class="tiers-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Тип</th>
                <th>Значение</th>
                <th>Пользователей</th>
                <th>Статус</th>
                <th>Создан</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($pricingTiers as $tier)
                <tr class="clickable-row" data-url="{{ route('admin.pricing-tiers.show', $tier) }}">
                    <td>{{ $tier->id }}</td>
                    <td>
                        <a href="{{ route('admin.pricing-tiers.show', $tier) }}" style="color: #3b82f6; text-decoration: none;">
                            {{ $tier->name }}
                        </a>
                    </td>
                    <td>
                            <span class="badge {{ $tier->type === 'percentage' ? 'badge-percentage' : 'badge-fixed' }}">
                                {{ $tier->type === 'percentage' ? 'Процент' : 'Фиксированная' }}
                            </span>
                    </td>
                    <td>
                        {{ $tier->type === 'percentage' ? $tier->value . '%' : number_format($tier->value, 0) . ' դր.' }}
                    </td>
                    <td>{{ $tier->users_count }}</td>
                    <td>
                            <span class="badge {{ $tier->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $tier->is_active ? 'Активен' : 'Неактивен' }}
                            </span>
                    </td>
                    <td>{{ $tier->created_at->format('d.m.Y') }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.pricing-tiers.edit', $tier) }}" class="btn-edit-icon" title="Редактировать">✏️</a>
                        <form action="{{ route('admin.pricing-tiers.toggle-status', $tier) }}" method="POST" class="toggle-form"
                              data-tier-name="{{ $tier->name }}" data-current-status="{{ $tier->is_active ? 'active' : 'inactive' }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-toggle-icon" title="{{ $tier->is_active ? 'Деактивировать' : 'Активировать' }}">
                                {{ $tier->is_active ? '🔴' : '🟢' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.pricing-tiers.destroy', $tier) }}" method="POST" class="delete-form"
                              data-tier-name="{{ $tier->name }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-icon" title="Удалить">🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px;">Никаких уровней ценообразования</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="pagination-container">
            {{ $pricingTiers->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/pricing-tiers.js'])
@endpush
