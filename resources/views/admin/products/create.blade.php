@extends('layouts.layout')

@section('title', __('admin.products.create.title') . ' — Админ')

@push('styles')
    @vite(['resources/css/admin/products.css'])
@endpush

@section('content')

    <h1 class="form-page-title">{{ __('admin.products.create.title') }}</h1>
    <p class="form-page-sub">{{ __('admin.products.create.subtitle') }}</p>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="error-box">
            <strong>{{ __('admin.products.create.errors_title') }}</strong>
            <ul>@foreach($errors->all() as $e)
                    <li>{{ __($e) }}</li>
                @endforeach</ul>
        </div>
    @endif

    <div class="tabs">
        <button class="tab-btn active" data-tab="info">📦 {{ __('admin.products.create.tabs.info') }}</button>
        <button class="tab-btn" data-tab="analogs">🔄 {{ __('admin.products.create.tabs.analogs') }}</button>
    </div>

    {{-- TAB 1: INFO --}}
    <div id="tab-info" class="tab-panel active">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">

                {{-- LEFT --}}
                <div>
                    <div class="form-card">
                        <div class="form-card-title">{{ __('admin.products.create.main_info') }}</div>
                        <div class="form-group">
                            <label for="name">{{ __('admin.products.create.name') }} *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="form-error">{{ __($message) }}</div> @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="sku">{{ __('admin.products.create.sku') }} *</label>
                                <input type="text" id="sku" name="sku" value="{{ old('sku') }}" required>
                                @error('sku')
                                <div class="form-error">{{ __($message) }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="brand">{{ __('admin.products.create.brand') }}</label>
                                <input type="text" id="brand" name="brand" value="{{ old('brand') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('admin.products.create.description') }}</label>
                            <textarea id="description" name="description">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-card">
                        <div class="form-card-title">{{ __('admin.products.create.price_stock') }}</div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="price">{{ __('admin.products.create.price') }}
                                    ({{ __('admin.products.currency') }}) *</label>
                                <input type="number" id="price" name="price" step="0.01" min="0"
                                       value="{{ old('price') }}" required>
                                @error('price')
                                <div class="form-error">{{ __($message) }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="quantity">{{ __('admin.products.create.quantity') }} *</label>
                                <input type="number" id="quantity" name="quantity" min="0"
                                       value="{{ old('quantity', 0) }}" required>
                                @error('quantity')
                                <div class="form-error">{{ __($message) }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-card">
                        <div class="form-card-title">
                            {{ __('admin.products.create.fits_cars') }}
                            <button type="button" id="clearAllModels"
                                    class="clear-models-btn">{{ __('admin.products.create.clear_all') }}</button>
                        </div>
                        <div class="cars-search-wrap">
                            <input type="text" id="carSearch"
                                   placeholder="{{ __('admin.products.create.search_models') }}"
                                   class="cars-search-input">
                            <span class="cars-selected-count" id="carsSelectedCount"></span>
                        </div>
                        <div class="makes-accordion">
                            @foreach($carMakes as $make)
                                <div class="make-group" data-make="{{ strtolower($make->name) }}">
                                    <div class="make-accordion-trigger" data-target="make-create-{{ $make->id }}">
                                        <span class="make-accordion-name">{{ $make->name }}</span>
                                        <span class="make-accordion-meta">
                                            <span
                                                class="make-model-count">{{ optional($make->carModels)->count() ?? 0 }} {{ __('admin.cars.models_short') }}</span>
                                            <span class="make-selected-badge" id="badge-create-{{ $make->id }}"
                                                  style="display:none">0</span>
                                        </span>
                                        <span class="make-accordion-arrow">
                                            <svg viewBox="0 0 10 10" fill="none" stroke="currentColor"
                                                 stroke-width="1.8"><polyline points="2,3.5 5,6.5 8,3.5"/></svg>
                                        </span>
                                    </div>
                                    <div class="models-list" id="make-create-{{ $make->id }}">
                                        @foreach($make->carModels as $model)
                                            <label class="model-check" data-model="{{ strtolower($model->name) }}">
                                                <input type="checkbox" name="car_models[]" value="{{ $model->id }}"
                                                       data-make-id="{{ $make->id }}">
                                                <span>{{ $model->name }}</span>
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
                        <div class="form-card-title">{{ __('admin.products.create.category') }} *</div>
                        <div class="form-group">
                            <select name="category_id" required>
                                <option value="">{{ __('admin.products.create.select_category') }}</option>
                                @foreach(App\Models\Category::flatTree() as $item)
                                    <option
                                        value="{{ $item['category']->id }}" {{ old('category_id') == $item['category']->id ? 'selected' : '' }}>
                                        {{ $item['depth'] > 0 ? '— ' : '' }}{{ $item['category']->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="form-error">{{ __($message) }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-card">
                        <div class="form-card-title">{{ __('admin.products.create.product_image') }}</div>

                        @include('components.image-upload', ['currentImage' => $product->image ?? null])

                        @error('image')
                        <div class="form-error">{{ __($message) }}</div>
                        @enderror
                    </div>

                    <div class="form-card">
                        <div class="form-card-title">{{ __('admin.products.create.publication') }}</div>
                        <div class="form-group">
                            <label class="check-label">
                                <input type="checkbox" name="is_active"
                                       value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                {{ __('admin.products.create.active_status') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-card">
                        <div class="form-card-title">
                            {{ __('admin.products.create.analogs') }}
                            <a href="{{ route('admin.analogs.create') }}"
                               target="_blank">+ {{ __('admin.products.create.create_new') }}</a>
                        </div>
                        @if($analogs->isEmpty())
                            <div class="analogs-empty">{{ __('admin.products.create.analogs_empty') }} <a
                                    href="{{ route('admin.analogs.create') }}"
                                    target="_blank">{{ __('admin.products.create.add_analog') }} →</a></div>
                        @else
                            <div class="analogs-scroll">
                                @foreach($analogs->groupBy('brand') as $brand => $group)
                                    <div class="analog-brand-group">
                                        <div class="analog-brand-label">{{ $brand }}</div>
                                        @foreach($group as $analog)
                                            <label class="analog-check-row">
                                                <input type="checkbox" name="analogs[]" value="{{ $analog->id }}">
                                                <span class="analog-check-sku">{{ $analog->sku }}</span>
                                                @if($analog->note)
                                                    <span class="analog-check-note">{{ $analog->note }}</span>
                                                @endif
                                            </label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <button type="submit"
                            class="btn btn-primary form-submit">{{ __('admin.products.create.save_button') }}</button>
                    <a href="{{ route('admin.products') }}"
                       class="form-back">← {{ __('admin.products.create.back_to_list') }}</a>
                </div>

            </div>
        </form>
    </div>

    {{-- TAB 2: ANALOGS --}}
    <div id="tab-analogs" class="tab-panel">
        <div class="analog-hint">
            {{ __('admin.products.create.analogs_hint') }}
            <a href="{{ route('admin.analogs.create') }}"
               target="_blank">{{ __('admin.products.create.create_analog') }} →</a>
        </div>

        <div class="analogs-layout">
            {{-- Выбранные аналоги (пока пусто) --}}
            <div class="analog-card">
                <div class="analog-card-header">
                    <span class="analog-card-title">{{ __('admin.products.create.selected_analogs') }}</span>
                    <span class="analog-card-count"
                          id="selectedAnalogsCount">0 {{ __('admin.products.create.pcs') }}</span>
                </div>
                <div id="selectedAnalogsList" class="analog-table"
                     style="padding: 1rem; text-align: center; color: var(--muted);">
                    {{ __('admin.products.create.nothing_selected') }}
                </div>
            </div>

            {{-- Доступные аналоги --}}
            <div class="analog-card">
                <div class="analog-card-header">
                    <span class="analog-card-title">{{ __('admin.products.create.available_analogs') }}</span>
                    <span class="analog-card-count">{{ $analogs->count() }} {{ __('admin.products.create.pcs') }}</span>
                </div>
                <div class="analog-search">
                    <input type="text" id="analogSearch" placeholder="{{ __('admin.products.create.search_analogs') }}">
                    <button type="button" id="searchAnalogBtn">{{ __('admin.products.create.search_btn') }}</button>
                </div>
                <div class="analogs-scroll" style="max-height: 400px; overflow-y: auto;">
                    @foreach($analogs->groupBy('brand') as $brand => $group)
                        <div class="analog-brand-group">
                            <div class="analog-brand-label">{{ $brand }}</div>
                            @foreach($group as $analog)
                                <label class="analog-check-row">
                                    <input type="checkbox" name="analogs_temp[]" value="{{ $analog->id }}"
                                           data-sku="{{ $analog->sku }}" data-brand="{{ $analog->brand }}"
                                           data-note="{{ $analog->note }}">
                                    <span class="analog-check-sku">{{ $analog->sku }}</span>
                                    @if($analog->note)
                                        <span class="analog-check-note">{{ $analog->note }}</span>
                                    @endif
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
                selectedList.innerHTML = '<div style="padding: 1rem; text-align: center; color: var(--muted);">{{ __('admin.products.create.nothing_selected') }}</div>';
                countSpan.textContent = '0 {{ __('admin.products.create.pcs') }}';
                return;
            }

            countSpan.textContent = selectedCheckboxes.length + ' {{ __('admin.products.create.pcs') }}';

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
                            <button type="button" class="analog-del-btn" data-id="${cb.value}">✕ {{ __('admin.products.create.remove') }}</button>
                        </td>
                    </tr>
                `;
            });
            html += '</tbody></table>';
            selectedList.innerHTML = html;

            // Добавляем обработчики для кнопок удаления
            document.querySelectorAll('#selectedAnalogsList .analog-del-btn').forEach(btn => {
                btn.addEventListener('click', function () {
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
            analogSearchInput.addEventListener('keydown', function (e) {
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
            mainForm.addEventListener('submit', function (e) {
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
