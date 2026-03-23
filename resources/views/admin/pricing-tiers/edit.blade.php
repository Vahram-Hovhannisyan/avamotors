@extends('layouts.layout')

@section('title', ' Изменить уровень ценообразования — AVAMotors')

@push('styles')
    @vite(['resources/css/admin/pricing-tiers.css'])
@endpush

@section('content')
    <div class="pricing-tiers-container">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('admin.pricing-tiers.index') }}" class="btn-back">
                ← Назад
            </a>
            <h1 class="pricing-tiers-title" style="margin-top: 20px;">Редактировать: {{ $pricingTier->name }}</h1>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.pricing-tiers.update', $pricingTier) }}" method="POST" id="pricing-tier-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Название *</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $pricingTier->name) }}" required>
                    @error('name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Тип *</label>
                    <select name="type" class="form-select" id="type-select" required>
                        <option value="percentage" {{ old('type', $pricingTier->type) == 'percentage' ? 'selected' : '' }}>Процент (%)</option>
                        <option value="fixed" {{ old('type', $pricingTier->type) == 'fixed' ? 'selected' : '' }}>Фиксированная сумма (դր.)</option>
                    </select>
                    @error('type')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Значение *
                        <span class="help-text" id="value-hint"></span>
                    </label>
                    <input type="number" name="value" step="0.01" class="form-input"
                           value="{{ old('value', $pricingTier->value) }}" required>
                    @error('value')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_active" value="1" id="is_active"
                            {{ old('is_active', $pricingTier->is_active) ? 'checked' : '' }}>
                        <label class="form-label" for="is_active" style="margin: 0; cursor: pointer;">
                            Активен
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="users-header">
                        <label class="form-label" style="margin: 0;">Пользователи</label>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <span class="users-count" id="selected-count">Выбрано: 0</span>
                            <span class="users-count">Всего: {{ count($users) }}</span>
                        </div>
                    </div>

                    <div class="user-search-wrapper">
                        <span class="search-icon">🔍</span>
                        <input type="text" id="user-search" class="user-search-input"
                               placeholder="Поиск по имени или email...">
                        <button type="button" id="clear-search" class="clear-search" title="Очистить поиск">✕</button>
                    </div>

                    <div class="users-list" id="users-list">
                        @forelse($users as $user)
                            <div class="user-checkbox"
                                 data-user-name="{{ strtolower($user->name) }}"
                                 data-user-email="{{ strtolower($user->email) }}">
                                <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                       id="user_{{ $user->id }}" class="user-checkbox-input"
                                    {{ in_array($user->id, $selectedUsers) ? 'checked' : '' }}>
                                <label for="user_{{ $user->id }}">
                                    <strong>{{ $user->name }}</strong>
                                    <br>
                                    <small>{{ $user->email }}</small>
                                </label>
                            </div>
                        @empty
                            <div class="no-results">
                                Нет пользователей
                            </div>
                        @endforelse
                    </div>

                    <div class="btn-select-group">
                        <button type="button" class="btn-select-all" id="select-all-btn">
                            ✓ Выбрать всех
                        </button>
                        <button type="button" class="btn-deselect-all" id="deselect-all-btn">
                            ✗ Снять всех
                        </button>
                        <button type="button" class="btn-select-visible" id="select-visible-btn">
                            ✓ Выбрать видимых
                        </button>
                    </div>
                </div>

                <div style="margin-top: 24px;">
                    <button type="submit" class="btn-submit">
                        Обновить уровень ценообразования
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/pricing-tiers.js'])
@endpush
