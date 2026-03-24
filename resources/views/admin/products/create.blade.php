@extends('layouts.layout')

@section('title', 'Создать товар — Админ')

@push('styles')
    @vite(['resources/css/admin/products.css'])
@endpush

@section('content')

    <h1 class="form-page-title">Создать товар</h1>
    <p class="form-page-sub">Заполните информацию о новом товаре</p>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="error-box">
            <strong>Пожалуйста, исправьте ошибки:</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="tabs">
        <button class="tab-btn active" data-tab="info">📦 Информация о товаре</button>
        <button class="tab-btn" data-tab="analogs">🔄 Аналоги</button>
    </div>

    {{-- TAB 1: INFO --}}
    <div id="tab-info" class="tab-panel active">
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
                        <div class="form-card-title">
                            Подходит для автомобилей
                            <button type="button" id="clearAllModels" class="clear-models-btn">Сбросить всё</button>
                        </div>
                        <div class="cars-search-wrap">
                            <input type="text" id="carSearch" placeholder="Поиск марки или модели..." class="cars-search-input">
                            <span class="cars-selected-count" id="carsSelectedCount"></span>
                        </div>
                        <div class="makes-accordion">
                            @foreach($carMakes as $make)
                                <div class="make-group" data-make="{{ strtolower($make->name) }}">
                                    <div class="make-accordion-trigger" data-target="make-create-{{ $make->id }}">
                                        <span class="make-accordion-name">{{ $make->name }}</span>
                                        <span class="make-accordion-meta">
                                            <span class="make-model-count">{{ $make->carModels->count() }} мод.</span>
                                            <span class="make-selected-badge" id="badge-create-{{ $make->id }}" style="display:none">0</span>
                                        </span>
                                        <span class="make-accordion-arrow">
                                            <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="2,3.5 5,6.5 8,3.5"/></svg>
                                        </span>
                                    </div>
                                    <div class="models-list" id="make-create-{{ $make->id }}">
                                        @foreach($make->carModels as $model)
                                            <label class="model-check" data-model="{{ strtolower($model->name) }}">
                                                <input type="checkbox" name="car_models[]" value="{{ $model->id }}" data-make-id="{{ $make->id }}">
                                                <span>{{ $model->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- БЛОК: Двигатели --}}
                    <div class="form-card">
                        <div class="form-card-title">
                            🔧 Совместимые двигатели
                            <button type="button" id="clearAllEnginesCreate" class="clear-models-btn" style="background: #ef4444;">Сбросить всё</button>
                        </div>
                        <div class="cars-search-wrap">
                            <input type="text" id="engineSearch" placeholder="Поиск двигателя по названию, коду, объему, мощности или топливу..." class="cars-search-input">
                            <span class="cars-selected-count" id="enginesSelectedCount"></span>
                        </div>
                        <div class="engines-list-scroll" style="max-height: 400px; overflow-y: auto; border: 1px solid var(--border); border-radius: 8px; padding: 8px;">
                            @foreach($carMakes as $make)
                                @php
                                    $makeEngines = $engines->where('carModel.car_make_id', $make->id);
                                @endphp
                                @if($makeEngines->count() > 0)
                                    <div class="engine-brand-group" data-make="{{ strtolower($make->name) }}" style="margin-bottom: 16px;">
                                        <div class="engine-brand-label" style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--brand); margin-bottom: 8px; padding: 4px 8px; background: var(--surface2); border-radius: 4px;">
                                            {{ $make->name }}
                                        </div>
                                        @foreach($makeEngines->groupBy('carModel.name') as $modelName => $modelEngines)
                                            <div class="engine-model-subgroup" style="margin-bottom: 12px;">
                                                <div class="engine-model-subtitle" style="font-size: 0.7rem; font-weight: 600; color: var(--muted); margin-bottom: 6px; padding-left: 8px;">
                                                    {{ $modelName }}
                                                </div>
                                                @foreach($modelEngines as $engine)
                                                    <div class="engine-item-row" data-engine="{{ strtolower($engine->name) }} {{ strtolower($engine->code ?? '') }} {{ $engine->displacement ?? '' }} {{ $engine->horsepower ?? '' }} {{ $engine->fuel_type ?? '' }}" style="margin-bottom: 4px;">
                                                        <label class="engine-check" style="display: flex; align-items: center; gap: 8px; padding: 6px 10px; border: 1px solid var(--border); border-radius: 6px; cursor: pointer; transition: all 0.2s;">
                                                            <input type="checkbox" name="engines[]" value="{{ $engine->id }}" data-make-id="{{ $make->id }}">
                                                            <span style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                                                <strong>{{ $engine->name }}</strong>
                                                                @if($engine->code)
                                                                    <code class="engine-code" style="font-size: 0.7rem; background: var(--surface2); padding: 2px 6px; border-radius: 4px;">{{ $engine->code }}</code>
                                                                @endif
                                                                @if($engine->displacement)
                                                                    <span class="engine-displacement" style="font-size: 0.65rem; color: #10b981;">{{ $engine->displacement }}L</span>
                                                                @endif
                                                                @if($engine->horsepower)
                                                                    <span class="engine-hp" style="font-size: 0.65rem; color: #f59e0b;">{{ $engine->horsepower }} л.с.</span>
                                                                @endif
                                                                @if($engine->fuel_type)
                                                                    <span class="engine-fuel" style="font-size: 0.65rem; color: #8b5cf6;">{{ $engine->fuel_type }}</span>
                                                                @endif
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @if($engines->count() === 0)
                            <div class="empty-state" style="padding: 20px; text-align: center; color: var(--muted);">
                                <p>Нет добавленных двигателей</p>
                                <a href="{{ route('admin.engines.create') }}" class="quick-link primary" style="display: inline-block; margin-top: 8px;">
                                    + Создать двигатель
                                </a>
                            </div>
                        @endif
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
                                    <option value="{{ $item['category']->id }}" {{ old('category_id') == $item['category']->id ? 'selected' : '' }}>
                                        {{ $item['depth'] > 0 ? '— ' : '' }}{{ $item['category']->name }}
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
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
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
                            <div class="analogs-empty">Справочник пуст. <a href="{{ route('admin.analogs.create') }}" target="_blank">Добавить →</a></div>
                        @else
                            <div class="analogs-scroll">
                                @foreach($analogs->groupBy('brand') as $brand => $group)
                                    <div class="analog-brand-group">
                                        <div class="analog-brand-label">{{ $brand }}</div>
                                        @foreach($group as $analog)
                                            <label class="analog-check-row">
                                                <input type="checkbox" name="analogs[]" value="{{ $analog->id }}">
                                                <span class="analog-check-sku">{{ $analog->sku }}</span>
                                                @if($analog->note)<span class="analog-check-note">{{ $analog->note }}</span>@endif
                                            </label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary form-submit">Сохранить товар</button>
                    <a href="{{ route('admin.products') }}" class="form-back">← Назад к списку</a>
                </div>

            </div>
        </form>
    </div>

    {{-- TAB 2: ANALOGS --}}
    <div id="tab-analogs" class="tab-panel">
        <div class="analog-hint">
            Выберите аналоги из справочника для нового товара.
            Для добавления нового — <a href="{{ route('admin.analogs.create') }}" target="_blank">создать аналог →</a>
        </div>

        <div class="analogs-layout">
            {{-- Выбранные аналоги (пока пусто) --}}
            <div class="analog-card">
                <div class="analog-card-header">
                    <span class="analog-card-title">Выбранные аналоги</span>
                    <span class="analog-card-count" id="selectedAnalogsCount">0 шт.</span>
                </div>
                <div id="selectedAnalogsList" class="analog-table" style="padding: 1rem; text-align: center; color: var(--muted);">
                    Ничего не выбрано
                </div>
            </div>

            {{-- Доступные аналоги --}}
            <div class="analog-card">
                <div class="analog-card-header">
                    <span class="analog-card-title">Доступные аналоги</span>
                    <span class="analog-card-count">{{ $analogs->count() }} шт.</span>
                </div>
                <div class="analog-search">
                    <input type="text" id="analogSearch" placeholder="Бренд или артикул...">
                    <button type="button" id="searchAnalogBtn">Найти</button>
                </div>
                <div class="analogs-scroll" style="max-height: 400px; overflow-y: auto;">
                    @foreach($analogs->groupBy('brand') as $brand => $group)
                        <div class="analog-brand-group">
                            <div class="analog-brand-label">{{ $brand }}</div>
                            @foreach($group as $analog)
                                <label class="analog-check-row">
                                    <input type="checkbox" name="analogs_temp[]" value="{{ $analog->id }}" data-sku="{{ $analog->sku }}" data-brand="{{ $analog->brand }}" data-note="{{ $analog->note }}">
                                    <span class="analog-check-sku">{{ $analog->sku }}</span>
                                    @if($analog->note)<span class="analog-check-note">{{ $analog->note }}</span>@endif
                                </label>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/products.js'])

    <script>
        // ==================== АНАЛОГИ ДЛЯ CREATE СТРАНИЦЫ ====================

        // Синхронизация выбранных аналогов
        function syncSelectedAnalogs() {
            const selectedCheckboxes = document.querySelectorAll('#tab-analogs input[name="analogs_temp[]"]:checked');
            const selectedList = document.getElementById('selectedAnalogsList');
            const countSpan = document.getElementById('selectedAnalogsCount');

            if (selectedCheckboxes.length === 0) {
                selectedList.innerHTML = '<div style="padding: 1rem; text-align: center; color: var(--muted);">Ничего не выбрано</div>';
                countSpan.textContent = '0 шт.';
                return;
            }

            countSpan.textContent = selectedCheckboxes.length + ' шт.';

            let html = '<table class="analog-table"><tbody>';
            selectedCheckboxes.forEach(cb => {
                const sku = cb.dataset.sku;
                const brand = cb.dataset.brand;
                const note = cb.dataset.note;
                html += `
                    <tr>
                        <td><span class="brand-pill">${brand}</span></td>
                        <td class="analog-sku">${sku}</td>
                        <td class="analog-note">${note || ''}</td>
                        <td class="analog-td-right">
                            <button type="button" class="analog-del-btn" data-id="${cb.value}">✕ Убрать</button>
                        </td>
                    </tr>
                `;
            });
            html += '</tbody></table>';
            selectedList.innerHTML = html;

            // Добавляем обработчики для кнопок удаления
            document.querySelectorAll('#selectedAnalogsList .analog-del-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const checkbox = document.querySelector(`#tab-analogs input[name="analogs_temp[]"][value="${id}"]`);
                    if (checkbox) checkbox.checked = false;
                    syncSelectedAnalogs();
                });
            });
        }

        // Поиск по аналогам
        function filterAnalogs() {
            const searchInput = document.getElementById('analogSearch');
            if (!searchInput) return;

            const searchTerm = searchInput.value.toLowerCase().trim();
            const analogGroups = document.querySelectorAll('#tab-analogs .analog-brand-group');

            analogGroups.forEach(group => {
                const brandName = group.querySelector('.analog-brand-label')?.innerText.toLowerCase() || '';
                const analogRows = group.querySelectorAll('.analog-check-row');
                let hasVisible = false;

                analogRows.forEach(row => {
                    const sku = row.querySelector('.analog-check-sku')?.innerText.toLowerCase() || '';
                    const note = row.querySelector('.analog-check-note')?.innerText.toLowerCase() || '';

                    if (searchTerm === '' || brandName.includes(searchTerm) || sku.includes(searchTerm) || note.includes(searchTerm)) {
                        row.style.display = '';
                        hasVisible = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                group.style.display = hasVisible ? '' : 'none';
            });
        }

        // Слушаем изменения чекбоксов аналогов
        document.querySelectorAll('#tab-analogs input[name="analogs_temp[]"]').forEach(cb => {
            cb.addEventListener('change', syncSelectedAnalogs);
        });

        // Поиск
        const analogSearchInput = document.getElementById('analogSearch');
        const searchBtn = document.getElementById('searchAnalogBtn');

        if (analogSearchInput) {
            analogSearchInput.addEventListener('input', filterAnalogs);
            analogSearchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    this.value = '';
                    filterAnalogs();
                }
            });
        }

        if (searchBtn) {
            searchBtn.addEventListener('click', filterAnalogs);
        }

        // Перед отправкой формы добавляем выбранные аналоги в основной массив
        const mainForm = document.querySelector('form[action*="products.store"]');
        if (mainForm) {
            mainForm.addEventListener('submit', function(e) {
                const selectedAnalogs = document.querySelectorAll('#tab-analogs input[name="analogs_temp[]"]:checked');
                selectedAnalogs.forEach(cb => {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'analogs[]';
                    hiddenInput.value = cb.value;
                    mainForm.appendChild(hiddenInput);
                });
            });
        }

        // Инициализация
        syncSelectedAnalogs();
    </script>
@endpush
