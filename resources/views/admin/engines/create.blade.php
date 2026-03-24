@extends('layouts.layout')

@section('title', 'Добавить двигатель — AVAMotors')

@push('styles')
    @vite(['resources/css/engine.css'])
@endpush

@section('content')
    <div class="form-container">
        <h1 class="form-title">➕ Добавить двигатель</h1>

        <form method="POST" action="{{ route('admin.engines.store') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Марка *</label>
                    <select name="make" id="make-select" class="form-control" required>
                        <option value="">Выберите марку</option>
                        @foreach($carMakes as $make)
                            <option value="{{ $make->id }}" {{ old('make') == $make->id ? 'selected' : '' }}>
                                {{ $make->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('make')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Модель *</label>
                    <select name="car_model_id" id="model-select" class="form-control" required>
                        <option value="">Сначала выберите марку</option>
                    </select>
                    @error('car_model_id')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Название двигателя *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Код двигателя</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="Например: 2GR-FE">
                    @error('code')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Объем (L)</label>
                    <input type="number" name="displacement" class="form-control" step="0.1" value="{{ old('displacement') }}">
                    @error('displacement')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Мощность (л.с.)</label>
                    <input type="number" name="horsepower" class="form-control" value="{{ old('horsepower') }}">
                    @error('horsepower')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Мощность (кВт)</label>
                    <input type="number" name="kw" class="form-control" value="{{ old('kw') }}">
                    @error('kw')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Тип топлива</label>
                    <select name="fuel_type" class="form-control">
                        <option value="">Выберите</option>
                        <option value="Бензин" {{ old('fuel_type') == 'Бензин' ? 'selected' : '' }}>Бензин</option>
                        <option value="Дизель" {{ old('fuel_type') == 'Дизель' ? 'selected' : '' }}>Дизель</option>
                        <option value="Гибрид" {{ old('fuel_type') == 'Гибрид' ? 'selected' : '' }}>Гибрид</option>
                        <option value="Электро" {{ old('fuel_type') == 'Электро' ? 'selected' : '' }}>Электро</option>
                        <option value="Газ" {{ old('fuel_type') == 'Газ' ? 'selected' : '' }}>Газ</option>
                    </select>
                    @error('fuel_type')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Цилиндры</label>
                    <input type="number" name="cylinders" class="form-control" value="{{ old('cylinders') }}">
                    @error('cylinders')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Клапаны</label>
                    <input type="text" name="valves" class="form-control" value="{{ old('valves') }}" placeholder="Например: 16">
                    @error('valves')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Топливная система</label>
                    <input type="text" name="fuel_system" class="form-control" value="{{ old('fuel_system') }}" placeholder="Инжектор, Common Rail и т.д.">
                    @error('fuel_system')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Турбо</label>
                    <select name="turbo" class="form-control">
                        <option value="">Выберите</option>
                        <option value="Атмосферный" {{ old('turbo') == 'Атмосферный' ? 'selected' : '' }}>Атмосферный</option>
                        <option value="Турбо" {{ old('turbo') == 'Турбо' ? 'selected' : '' }}>Турбо</option>
                        <option value="Твин-турбо" {{ old('turbo') == 'Твин-турбо' ? 'selected' : '' }}>Твин-турбо</option>
                    </select>
                    @error('turbo')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Год от</label>
                    <input type="number" name="year_from" class="form-control" value="{{ old('year_from') }}" placeholder="1990">
                    @error('year_from')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Год до</label>
                    <input type="number" name="year_to" class="form-control" value="{{ old('year_to') }}" placeholder="2020">
                    @error('year_to')
                    <div class="help-text" style="color: #ef4444;">{{ $message }}</div>
                    @enderror
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

            @if(old('make'))
            document.getElementById('make-select').dispatchEvent(new Event('change'));
            @if(old('car_model_id'))
            setTimeout(() => {
                document.getElementById('model-select').value = '{{ old('car_model_id') }}';
            }, 100);
            @endif
            @endif
        </script>
    @endpush
@endsection
