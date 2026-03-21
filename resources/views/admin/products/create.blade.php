@extends('layouts.layout')

@section('title', 'Добавить товар — Админ')

@push('styles')
    @vite(['resources/css/admin/products.css'])
@endpush

@section('content')

    <h1 class="form-page-title">Добавить товар</h1>

    @if($errors->any())
        <div class="error-box">
            <strong>Пожалуйста, исправьте ошибки:</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">

            {{-- LEFT --}}
            <div>
                <div class="form-card">
                    <div class="form-card-title">Основная информация</div>
                    <div class="form-group">
                        <label for="name">Название *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="sku">SKU / Артикул *</label>
                            <input type="text" id="sku" name="sku" value="{{ old('sku') }}" required>
                            @error('sku') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="brand">Бренд</label>
                            <input type="text" id="brand" name="brand" value="{{ old('brand') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea id="description" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">Цена и склад</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="price">Цена (դր.) *</label>
                            <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                            @error('price') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Количество *</label>
                            <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', 0) }}" required>
                            @error('quantity') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">Подходит для автомобилей</div>

                    {{-- Поиск по маркам --}}
                    <div class="cars-search-wrap">
                        <input type="text" id="carSearch"
                               placeholder="Поиск марки или модели..."
                               class="cars-search-input">
                        <span class="cars-selected-count" id="carsSelectedCount"></span>
                    </div>

                    <div class="makes-accordion" id="makesAccordion">
                        @foreach($carMakes as $make)
                            @php
                                $selectedModels = collect(old('car_models', []))->map('intval');
                                $hasSelected    = $make->carModels->contains(fn($m) => $selectedModels->contains($m->id));
                            @endphp
                            <div class="make-group" data-make="{{ strtolower($make->name) }}">
                                <div class="make-accordion-trigger {{ $hasSelected ? 'has-selected' : '' }}"
                                     data-target="make-{{ $make->id }}">
                                    <span class="make-accordion-name">{{ $make->name }}</span>
                                    <span class="make-accordion-meta">
                                        <span class="make-model-count">{{ $make->carModels->count() }} мод.</span>
                                        @if($hasSelected)
                                            <span class="make-selected-badge" id="badge-{{ $make->id }}">
                                                {{ $make->carModels->filter(fn($m) => $selectedModels->contains($m->id))->count() }}
                                            </span>
                                        @else
                                            <span class="make-selected-badge" id="badge-{{ $make->id }}" style="display:none">0</span>
                                        @endif
                                    </span>
                                    <span class="make-accordion-arrow">
                                        <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><polyline points="2,3.5 5,6.5 8,3.5"/></svg>
                                    </span>
                                </div>
                                <div class="models-list {{ $hasSelected ? 'open' : '' }}" id="make-{{ $make->id }}">
                                    @foreach($make->carModels as $model)
                                        <label class="model-check"
                                               data-model="{{ strtolower($model->name) }}">
                                            <input type="checkbox"
                                                   name="car_models[]"
                                                   value="{{ $model->id }}"
                                                   data-make-id="{{ $make->id }}"
                                                {{ in_array($model->id, old('car_models', [])) ? 'checked' : '' }}>
                                            {{ $model->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div>
                <div class="form-card">
                    <div class="form-card-title">Категория *</div>
                    <div class="form-group">
                        <select name="category_id" required>
                            <option value="">— Выберите категорию —</option>
                            @foreach(App\Models\Category::flatTree() as $item)
                                <option value="{{ $item['category']->id }}"
                                    {{ old('category_id') == $item['category']->id ? 'selected' : '' }}>
                                    {{ str_repeat('&nbsp;&nbsp;&nbsp;', $item['depth']) }}{{ $item['depth'] > 0 ? '└ ' : '' }}{{ $item['category']->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">Изображение товара</div>
                    <div class="img-preview" id="preview-box">
                        <span class="img-placeholder">Нет изображения</span>
                    </div>
                    <div class="form-group">
                        <label for="image">Загрузить изображение</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        @error('image') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">Публикация</div>
                    <div class="form-group">
                        <label class="check-label">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}>
                            Товар активен (виден покупателям)
                        </label>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">
                        Аналоги
                        <a href="{{ route('admin.analogs.create') }}" target="_blank">+ создать новый</a>
                    </div>
                    @if($analogs->isEmpty())
                        <div class="analogs-empty">Справочник аналогов пуст. <a href="{{ route('admin.analogs.create') }}" target="_blank">Добавить →</a></div>
                    @else
                        <div class="analogs-scroll">
                            @foreach($analogs->groupBy('brand') as $brand => $group)
                                <div class="analog-brand-group">
                                    <div class="analog-brand-label">{{ $brand }}</div>
                                    @foreach($group as $analog)
                                        <label class="analog-check-row">
                                            <input type="checkbox" name="analogs[]" value="{{ $analog->id }}"
                                                {{ in_array($analog->id, old('analogs', [])) ? 'checked' : '' }}>
                                            <span class="analog-check-sku">{{ $analog->sku }}</span>
                                            @if($analog->note)<span class="analog-check-note">{{ $analog->note }}</span>@endif
                                        </label>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary form-submit">Создать товар</button>
                <a href="{{ route('admin.products') }}" class="form-back">← Назад к списку</a>
            </div>

        </div>
    </form>

@endsection

@push('scripts')
    @vite(['resources/js/admin/products.js'])
@endpush
