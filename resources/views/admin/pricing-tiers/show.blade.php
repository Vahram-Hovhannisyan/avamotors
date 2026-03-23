@extends('layouts.layout')

@section('title', 'Просмотр Pricing Tier — AVAMotors')

@push('styles')
    @vite(['resources/css/admin/pricing-tiers.css'])
@endpush

@section('content')
    <div class="pricing-tiers-container">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('admin.pricing-tiers.index') }}" class="btn-back">
                ← Назад
            </a>
            <a href="{{ route('admin.pricing-tiers.edit', $pricingTier) }}" class="btn-edit">
                ✏️ Редактировать
            </a>
            <h1 class="pricing-tiers-title" style="margin-top: 20px;">Просмотр Pricing Tier</h1>
        </div>

        <div class="details-container">
            <div class="detail-row">
                <div class="detail-label">ID:</div>
                <div class="detail-value">{{ $pricingTier->id }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Название:</div>
                <div class="detail-value">{{ $pricingTier->name }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Тип:</div>
                <div class="detail-value">
                    <span class="badge {{ $pricingTier->type === 'percentage' ? 'badge-percentage' : 'badge-fixed' }}">
                        {{ $pricingTier->type === 'percentage' ? 'Процент' : 'Фиксированная сумма' }}
                    </span>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Значение:</div>
                <div class="detail-value">
                    {{ $pricingTier->type === 'percentage' ? $pricingTier->value . '%' : number_format($pricingTier->value, 0) . ' դր.' }}
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Статус:</div>
                <div class="detail-value">
                    <span class="badge {{ $pricingTier->is_active ? 'badge-active' : 'badge-inactive' }}">
                        {{ $pricingTier->is_active ? 'Активен' : 'Неактивен' }}
                    </span>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Создан:</div>
                <div class="detail-value">{{ $pricingTier->created_at->format('d.m.Y H:i') }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Обновлен:</div>
                <div class="detail-value">{{ $pricingTier->updated_at->format('d.m.Y H:i') }}</div>
            </div>

            <div class="users-section" style="margin-top: 24px;">
                <h3 style="margin-bottom: 12px;">Пользователи ({{ $usersCount }})</h3>
                <div class="users-list">
                    @forelse($pricingTier->users as $user)
                        <div class="user-item" style="display: flex; justify-content: space-between; align-items: center; padding: 12px; border-bottom: 1px solid #f3f4f6;">
                            <div>
                                <strong>{{ $user->name }}</strong>
                                <br>
                                <small style="color: #6b7280;">{{ $user->email }}</small>
                            </div>
                            <form action="{{ route('admin.pricing-tiers.remove-users', $pricingTier) }}" method="POST"
                                  class="remove-user-form" data-user-name="{{ $user->name }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                                <button type="submit" class="btn-delete-icon" style="background: none; border: none; cursor: pointer;">🗑️</button>
                            </form>
                        </div>
                    @empty
                        <div style="padding: 24px; text-align: center; color: #6b7280;">
                            Нет привязанных пользователей
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/pricing-tiers.js'])
@endpush
