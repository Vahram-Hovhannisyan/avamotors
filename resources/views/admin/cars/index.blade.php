@extends('layouts.layout')

@section('title', 'Марки и модели — Админ')

@push('styles')
    @vite(['resources/css/admin/cars-index.css'])
@endpush

@section('content')

    <div class="page-header">
        <h1 class="page-title">Марки и модели</h1>
        <span class="page-date">{{ now()->format('d.m.Y') }}</span>
    </div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    @if($errors->has('error'))
        <div class="flash-error">{{ $errors->first('error') }}</div>
    @endif

    <div class="quick-actions">
        <a href="{{ route('admin.dashboard') }}" class="quick-link">← Дашборд</a>
        <a href="{{ route('admin.products') }}"  class="quick-link">Товары</a>
    </div>

    <div class="page-layout">

        {{-- ── МАРКИ ── --}}
        <div class="section-card">
            <div class="section-card-header">
                <span class="section-card-title">Марки</span>
                <span class="section-card-count">{{ $makes->total() }} шт.</span>
            </div>
            <div class="section-card-body">

                {{-- Добавить марку --}}
                <form method="POST" action="{{ route('admin.cars.makes.store') }}">
                    @csrf
                    <div class="make-form-row">
                        <input type="text" name="name" class="f-input" placeholder="Название (Toyota...)" required value="{{ old('name') }}">
                        <button type="submit" class="f-btn">+ Добавить</button>
                    </div>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </form>

                {{-- Поиск марки --}}
                <form method="GET" action="" class="search-form">
                    @if(request('models_page')) <input type="hidden" name="models_page" value="{{ request('models_page') }}"> @endif
                    @if($modelSearch) <input type="hidden" name="model_search" value="{{ $modelSearch }}"> @endif
                    <div class="search-row">
                        <input type="text" name="make_search" class="f-input" placeholder="Поиск марки..." value="{{ $makeSearch }}">
                        @if($makeSearch)
                            <a href="{{ request()->fullUrlWithoutQuery(['make_search', 'page']) }}" class="f-btn-ghost">✕</a>
                        @endif
                    </div>
                </form>

                <table class="data-table">
                    <thead><tr><th>Марка</th><th>Моделей</th><th></th></tr></thead>
                    <tbody>
                    @forelse($makes as $make)
                        <tr>
                            <td class="fw-500">{{ $make->name }}</td>
                            <td class="text-muted">{{ $make->car_models_count }}</td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('admin.cars.makes.destroy', $make) }}"
                                      onsubmit="return confirm('Удалить марку «{{ $make->name }}»?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="del-btn">✕ Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="empty-cell">
                                {{ $makeSearch ? 'Ничего не найдено' : 'Марки не добавлены' }}
                            </td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($makes->hasPages())
                <div class="pagination-wrap">{{ $makes->links() }}</div>
            @endif
        </div>

        {{-- ── МОДЕЛИ ── --}}
        <div class="section-card">
            <div class="section-card-header">
                <span class="section-card-title">Модели</span>
                <span class="section-card-count">{{ $models->total() }} шт.</span>
            </div>
            <div class="section-card-body">

                {{-- Добавить модели --}}
                <form method="POST" action="{{ route('admin.cars.models.store') }}">
                    @csrf
                    <div class="model-form">
                        <div class="model-form-top">
                            <select name="car_make_id" class="f-select" required>
                                <option value="">— Марка —</option>
                                @foreach($allMakes as $make)
                                    <option value="{{ $make->id }}" {{ old('car_make_id') == $make->id ? 'selected' : '' }}>
                                        {{ $make->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="model-names-list" id="modelNamesList">
                            <div class="model-name-row">
                                <input type="text" name="names[]" class="f-input" placeholder="Модель (Camry...)" required>
                                <button type="button" class="f-btn-ghost remove-row-btn" style="display:none;" title="Удалить">✕</button>
                            </div>
                        </div>
                        <div class="model-form-footer">
                            <button type="button" class="add-row-btn" id="addRowBtn">+ ещё модель</button>
                            <button type="submit" class="f-btn">Сохранить</button>
                        </div>
                        @error('names')   <div class="form-error">{{ $message }}</div> @enderror
                        @error('names.0') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </form>

                {{-- Поиск модели --}}
                <form method="GET" action="" class="search-form">
                    @if($makeSearch) <input type="hidden" name="make_search" value="{{ $makeSearch }}"> @endif
                    <div class="search-row">
                        <input type="text" name="model_search" class="f-input" placeholder="Поиск по марке или модели..." value="{{ $modelSearch }}">
                        @if($modelSearch)
                            <a href="{{ request()->fullUrlWithoutQuery(['model_search', 'models_page']) }}" class="f-btn-ghost">✕</a>
                        @endif
                    </div>
                </form>

                <table class="data-table">
                    <thead><tr><th>Марка</th><th>Модель</th><th></th></tr></thead>
                    <tbody>
                    @forelse($models as $model)
                        <tr>
                            <td class="text-muted text-sm">{{ $model->carMake->name }}</td>
                            <td class="fw-500">{{ $model->name }}</td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('admin.cars.models.destroy', $model) }}"
                                      onsubmit="return confirm('Удалить модель «{{ $model->name }}»?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="del-btn">✕</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="empty-cell">
                                {{ $modelSearch ? 'Ничего не найдено' : 'Модели не добавлены' }}
                            </td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($models->hasPages())
                <div class="pagination-wrap">{{ $models->appends(request()->except('models_page'))->links() }}</div>
            @endif
        </div>

    </div>

@endsection

@push('scripts')
    @vite(['resources/js/admin/cars-index.js'])
@endpush
