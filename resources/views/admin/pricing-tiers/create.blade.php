@extends('layouts.layout')

@section('title', 'Создать Pricing Tier — AVAMotors')

@push('styles')
    @vite(['resources/css/admin/pricing-tiers.css'])
@endpush

@section('content')
    <div class="pricing-tiers-container">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('admin.pricing-tiers.index') }}" class="btn-back">
                ← Назад
            </a>
            <h1 class="pricing-tiers-title" style="margin-top: 20px;">Создать уровень ценообразования</h1>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.pricing-tiers.store') }}" method="POST" id="pricing-tier-form">
                @csrf

                <div class="form-group">
                    <label class="form-label">Название *</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name') }}"
                           placeholder="Например: VIP, Оптовый, Премиум" required>
                    @error('name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Тип *</label>
                    <select name="type" class="form-select" id="type-select" required>
                        <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Процент (%)</option>
                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Фиксированная сумма (դր.)</option>
                    </select>
                    @error('type')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Значение *
                        <span class="help-text" id="value-hint">
                            @if(old('type', 'percentage') == 'percentage')
                                (10 = 10% скидка)
                            @else
                                (1000 = 1000 դր. скидка)
                            @endif
                        </span>
                    </label>
                    <input type="number" name="value" step="0.01" class="form-input"
                           value="{{ old('value') }}" placeholder="Введите значение" required>
                    @error('value')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_active" value="1" id="is_active"
                            {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-label" for="is_active" style="margin: 0; cursor: pointer;">
                            Активен
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="users-header">
                        <label class="form-label" style="margin: 0;">Пользователи (опционально)</label>
                        <span class="users-count" id="selected-count">Выбрано: 0</span>
                    </div>

                    @if(count($users) > 10)
                        <div style="margin-bottom: 12px;">
                            <input type="text" id="user-search" class="form-input"
                                   placeholder="Поиск пользователей..." style="padding: 8px;">
                        </div>
                    @endif

                    <div class="users-list">
                        @forelse($users as $user)
                            <div class="user-checkbox">
                                <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                       id="user_{{ $user->id }}" class="user-checkbox-input">
                                <label for="user_{{ $user->id }}">
                                    <strong>{{ $user->name }}</strong>
                                    <br>
                                    <small>{{ $user->email }}</small>
                                </label>
                            </div>
                        @empty
                            <div style="padding: 12px; text-align: center; color: #6b7280;">
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
                    </div>
                </div>

                <div style="margin-top: 24px;">
                    <button type="submit" class="btn-submit">
                        Создать уровень ценообразования
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/pricing-tiers.js'])
@endpush
