@extends('layouts.layout')

@section('title', 'Редактировать товар — Админ')

@push('styles')
    @vite(['resources/css/admin/products.css'])
@endpush

@section('content')

    <h1 class="form-page-title">{{ $product->name }}</h1>
    <p class="form-page-sub">Арт. {{ $product->sku }} &nbsp;·&nbsp; {{ $product->category->name }}</p>

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
        <button class="tab-btn {{ request('tab') === 'analogs' ? 'active' : '' }}" data-tab="analogs">
            🔄 Аналоги
            <span class="tab-badge {{ $product->analogs->count() === 0 ? 'empty' : '' }}">{{ $product->analogs->count() }}</span>
        </button>
    </div>

    {{-- TAB 1: INFO --}}
    <div id="tab-info" class="tab-panel active">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid">

                {{-- LEFT --}}
                <div>
                    <div class="form-card">
                        <div class="form-card-title">Основная информация</div>
                        <div class="form-group">
                            <label for="name">Название *</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="sku">SKU / Артикул *</label>
                                <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                                @error('sku') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="brand">Бренд</label>
                                <input type="text" id="brand" name="brand" value="{{ old('brand', $product->brand) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <div class="form-card">
                        <div class="form-card-title">Цена и склад</div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="price">Цена (դր.) *</label>
                                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
                                @error('price') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="quantity">Количество *</label>
                                <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', $product->quantity) }}" required>
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
                                @php
                                    $selectedCount = $make->carModels->filter(fn($m) =>
                                        $product->carModels->contains($m->id) || in_array($m->id, old('car_models', []))
                                    )->count();
                                @endphp
                                <div class="make-group {{ $selectedCount > 0 ? 'open' : '' }}" data-make="{{ strtolower($make->name) }}">
                                    <div class="make-accordion-trigger {{ $selectedCount > 0 ? 'has-selected' : '' }}" data-target="make-edit-{{ $make->id }}">
                                        <span class="make-accordion-name">{{ $make->name }}</span>
                                        <span class="make-accordion-meta">
                                            <span class="make-model-count">{{ $make->carModels->count() }} мод.</span>
                                            <span class="make-selected-badge" id="badge-edit-{{ $make->id }}" {{ $selectedCount === 0 ? 'style="display:none"' : '' }}>{{ $selectedCount }}</span>
                                        </span>
                                        <span class="make-accordion-arrow">
                                            <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><polyline points="2,3.5 5,6.5 8,3.5"/></svg>
                                        </span>
                                    </div>
                                    <div class="models-list {{ $selectedCount > 0 ? 'open' : '' }}" id="make-edit-{{ $make->id }}">
                                        @foreach($make->carModels as $model)
                                            <label class="model-check" data-model="{{ strtolower($model->name) }}">
                                                <input type="checkbox" name="car_models[]" value="{{ $model->id }}" data-make-id="{{ $make->id }}"
                                                    {{ $product->carModels->contains($model->id) || in_array($model->id, old('car_models', [])) ? 'checked' : '' }}>
                                                <span>{{ $model->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- ✅ НОВЫЙ БЛОК: Двигатели --}}
                    <div class="form-card">
                        <div class="form-card-title">
                            🔧 Совместимые двигатели
                            <button type="button" id="clearAllEngines" class="clear-models-btn" style="background: #ef4444;">Сбросить всё</button>
                        </div>
                        <div class="cars-search-wrap">
                            <input type="text" id="engineSearch" placeholder="Поиск двигателя по названию или коду..." class="cars-search-input">
                            <span class="cars-selected-count" id="enginesSelectedCount"></span>
                        </div>
                        <div class="makes-accordion engines-accordion">
                            @foreach($carMakes as $make)
                                @php
                                    $makeEngines = $engines->where('carModel.car_make_id', $make->id);
                                    $selectedEngineCount = $makeEngines->filter(fn($e) =>
                                        $product->engines->contains($e->id) || in_array($e->id, old('engines', []))
                                    )->count();
                                @endphp
                                @if($makeEngines->count() > 0)
                                    <div class="make-group engine-group {{ $selectedEngineCount > 0 ? 'open' : '' }}" data-make="{{ strtolower($make->name) }}">
                                        <div class="make-accordion-trigger {{ $selectedEngineCount > 0 ? 'has-selected' : '' }}" data-target="engine-make-{{ $make->id }}">
                                            <span class="make-accordion-name">{{ $make->name }}</span>
                                            <span class="make-accordion-meta">
                                                <span class="make-model-count">{{ $makeEngines->count() }} двиг.</span>
                                                <span class="make-selected-badge engine-badge" id="engine-badge-{{ $make->id }}" {{ $selectedEngineCount === 0 ? 'style="display:none"' : '' }}>{{ $selectedEngineCount }}</span>
                                            </span>
                                            <span class="make-accordion-arrow">
                                                <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="2,3.5 5,6.5 8,3.5"/></svg>
                                            </span>
                                        </div>
                                        <div class="models-list engine-models-list {{ $selectedEngineCount > 0 ? 'open' : '' }}" id="engine-make-{{ $make->id }}">
                                            @foreach($makeEngines->groupBy('carModel.name') as $modelName => $modelEngines)
                                                <div class="engine-model-group">
                                                    <div class="engine-model-title">{{ $modelName }}</div>
                                                    @foreach($modelEngines as $engine)
                                                        <label class="model-check engine-check" data-engine="{{ strtolower($engine->name) }} {{ strtolower($engine->code ?? '') }}">
                                                            <input type="checkbox" name="engines[]" value="{{ $engine->id }}" data-make-id="{{ $make->id }}"
                                                                {{ $product->engines->contains($engine->id) || in_array($engine->id, old('engines', [])) ? 'checked' : '' }}>
                                                            <span>
                                                                <strong>{{ $engine->name }}</strong>
                                                                @if($engine->code)
                                                                    <code class="engine-code">({{ $engine->code }})</code>
                                                                @endif
                                                                @if($engine->displacement)
                                                                    <span class="engine-displacement">{{ $engine->displacement }}L</span>
                                                                @endif
                                                                @if($engine->horsepower)
                                                                    <span class="engine-hp">{{ $engine->horsepower }} л.с.</span>
                                                                @endif
                                                                @if($engine->fuel_type)
                                                                    <span class="engine-fuel">{{ $engine->fuel_type }}</span>
                                                                @endif
                                                            </span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
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
                                    <option value="{{ $item['category']->id }}"
                                        {{ old('category_id', $product->category_id) == $item['category']->id ? 'selected' : '' }}>
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
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="">
                            @else
                                <span class="img-placeholder">Нет изображения</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image">Загрузить изображение</label>
                            <input type="file" id="image" name="image" accept="image/*">
                            @error('image') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        @if($product->image)
                            <label class="check-label" style="margin-top:0.5rem;">
                                <input type="checkbox" name="remove_image" value="1">
                                Удалить текущее изображение
                            </label>
                        @endif
                    </div>

                    <div class="form-card">
                        <div class="form-card-title">Публикация</div>
                        <div class="form-group">
                            <label class="check-label">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
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
                                                <input type="checkbox" name="analogs[]" value="{{ $analog->id }}"
                                                    {{ $product->analogs->contains($analog->id) || in_array($analog->id, old('analogs', [])) ? 'checked' : '' }}>
                                                <span class="analog-check-sku">{{ $analog->sku }}</span>
                                                @if($analog->note)<span class="analog-check-note">{{ $analog->note }}</span>@endif
                                            </label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary form-submit">Сохранить изменения</button>
                    <a href="{{ route('admin.products') }}" class="form-back">← Назад к списку</a>
                </div>

            </div>
        </form>
    </div>

    {{-- TAB 2: ANALOGS --}}
    <div id="tab-analogs" class="tab-panel {{ request('tab') === 'analogs' ? 'active' : '' }}">

        <div class="analog-hint">
            Выберите аналоги из справочника для детали <strong>{{ $product->sku }}</strong>.
            Для добавления нового — <a href="{{ route('admin.analogs.create') }}" target="_blank">создать аналог →</a>
        </div>

        <div class="analogs-layout">

            {{-- Current --}}
            <div class="analog-card">
                <div class="analog-card-header">
                    <span class="analog-card-title">Привязанные аналоги</span>
                    <span class="analog-card-count">{{ $product->analogs->count() }} шт.</span>
                </div>
                <table class="analog-table">
                    <tbody>
                    @forelse($product->analogs as $a)
                        <tr>
                            <td><span class="brand-pill">{{ $a->brand }}</span></td>
                            <td class="analog-sku">{{ $a->sku }}</td>
                            <td class="analog-note">{{ $a->note ?? '' }}</td>
                            <td class="analog-td-right">
                                <form method="POST" action="{{ route('admin.products.analogs.detach', [$product, $a]) }}">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="tab" value="analogs">
                                    <button type="submit" class="analog-del-btn">✕ Убрать</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-analog">Аналоги не привязаны</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Add from directory --}}
            <div class="analog-card">
                <div class="analog-card-header">
                    <span class="analog-card-title">Добавить из справочника</span>
                    <span class="analog-card-count">{{ $suggestions->total() }} доступно</span>
                </div>
                <form method="GET" class="analog-search">
                    <input type="hidden" name="tab" value="analogs">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Бренд или артикул...">
                    <button type="submit">Найти</button>
                </form>
                <table class="analog-table">
                    <tbody>
                    @forelse($suggestions as $s)
                        <tr>
                            <td><span class="brand-pill">{{ $s->brand }}</span></td>
                            <td class="analog-sku">{{ $s->sku }}</td>
                            <td class="analog-note">{{ $s->note ?? '' }}</td>
                            <td class="analog-td-right-lg">
                                <form method="POST" action="{{ route('admin.products.analogs.attach', [$product, $s]) }}">
                                    @csrf
                                    <input type="hidden" name="tab" value="analogs">
                                    <button type="submit" class="analog-add-btn">+ Добавить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-analog">
                                {{ request('q') ? 'Ничего не найдено по «' . request('q') . '»' : 'Все аналоги уже добавлены' }}
                            </td></tr>
                    @endforelse
                    </tbody>
                </table>
                @if($suggestions->hasPages())
                    <div class="analog-footer">{{ $suggestions->appends(['tab' => 'analogs', 'q' => request('q')])->links() }}</div>
                @endif
                <div class="analog-footer">
                    <a href="{{ route('admin.analogs.create') }}" target="_blank">+ Создать новый аналог в справочнике →</a>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/products.js'])
@endpush
