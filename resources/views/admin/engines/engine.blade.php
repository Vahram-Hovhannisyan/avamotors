@extends('layouts.layout')

@section('title', 'Редактировать двигатель — AVAMotors')

@push('styles')
    @vite(['resources/css/engine.css'])
@endpush

@section('content')
    <div class="form-container">
        <h1 class="form-title">✏️ Редактировать двигатель</h1>

        <form method="POST" action="{{ route('admin.engines.update', $engine) }}">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Марка *</label>
                    <select name="make" id="make-select" class="form-control" required>
                        <option value="">Выберите марку</option>
                        @foreach($carMakes as $make)
                            <option value="{{ $make->id }}" {{ $engine->carModel->car_make_id == $make->id ? 'selected' : '' }}>
                                {{ $make->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Модель *</label>
                    <select name="car_model_id" id="model-select" class="form-control" required>
                        <option value="">Выберите модель</option>
                        @foreach($carMakes->find($engine->carModel->car_make_id)?->carModels ?? [] as $model)
                            <option value="{{ $model->id }}" {{ $engine->car_model_id == $model->id ? 'selected' : '' }}>
                                {{ $model->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Название двигателя *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $engine->name) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Код двигателя</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code', $engine->code) }}" placeholder="Например: 2GR-FE">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Объем (L)</label>
                    <input type="number" name="displacement" class="form-control" step="0.1" value="{{ old('displacement', $engine->displacement) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Мощность (л.с.)</label>
                    <input type="number" name="horsepower" class="form-control" value="{{ old('horsepower', $engine->horsepower) }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Мощность (кВт)</label>
                    <input type="number" name="kw" class="form-control" value="{{ old('kw', $engine->kw) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Тип топлива</label>
                    <select name="fuel_type" class="form-control">
                        <option value="">Выберите</option>
                        <option value="Бензин" {{ old('fuel_type', $engine->fuel_type) == 'Бензин' ? 'selected' : '' }}>Бензин</option>
                        <option value="Дизель" {{ old('fuel_type', $engine->fuel_type) == 'Дизель' ? 'selected' : '' }}>Дизель</option>
                        <option value="Гибрид" {{ old('fuel_type', $engine->fuel_type) == 'Гибрид' ? 'selected' : '' }}>Гибрид</option>
                        <option value="Электро" {{ old('fuel_type', $engine->fuel_type) == 'Электро' ? 'selected' : '' }}>Электро</option>
                        <option value="Газ" {{ old('fuel_type', $engine->fuel_type) == 'Газ' ? 'selected' : '' }}>Газ</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Цилиндры</label>
                    <input type="number" name="cylinders" class="form-control" value="{{ old('cylinders', $engine->cylinders) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Клапаны</label>
                    <input type="text" name="valves" class="form-control" value="{{ old('valves', $engine->valves) }}" placeholder="Например: 16">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Топливная система</label>
                    <input type="text" name="fuel_system" class="form-control" value="{{ old('fuel_system', $engine->fuel_system) }}" placeholder="Инжектор, Common Rail и т.д.">
                </div>

                <div class="form-group">
                    <label class="form-label">Турбо</label>
                    <select name="turbo" class="form-control">
                        <option value="">Выберите</option>
                        <option value="Атмосферный" {{ old('turbo', $engine->turbo) == 'Атмосферный' ? 'selected' : '' }}>Атмосферный</option>
                        <option value="Турбо" {{ old('turbo', $engine->turbo) == 'Турбо' ? 'selected' : '' }}>Турбо</option>
                        <option value="Твин-турбо" {{ old('turbo', $engine->turbo) == 'Твин-турбо' ? 'selected' : '' }}>Твин-турбо</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Год от</label>
                    <input type="number" name="year_from" class="form-control" value="{{ old('year_from', $engine->year_from) }}" placeholder="1990">
                </div>

                <div class="form-group">
                    <label class="form-label">Год до</label>
                    <input type="number" name="year_to" class="form-control" value="{{ old('year_to', $engine->year_to) }}" placeholder="2020">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Сохранить</button>
                <a href="{{ route('admin.engines.index') }}" class="btn-cancel">Отмена</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            const modelsData = @json($carMakes->mapWithKeys(fn($make) => [
            $make->id => $make->carModels->map(fn($model) => ['id' => $model->id, 'name' => $model->name])
        ]));

            document.getElementById('make-select').addEventListener('change', function() {
                const makeId = this.value;
                const modelSelect = document.getElementById('model-select');
                const models = modelsData[makeId] || [];

                modelSelect.innerHTML = '<option value="">Выберите модель</option>';
                models.forEach(model => {
                    const option = document.createElement('option');
                    option.value = model.id;
                    option.textContent = model.name;
                    modelSelect.appendChild(option);
                });
            });
        </script>
    @endpush
@endsection
