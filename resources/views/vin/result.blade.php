@extends('layouts.layout')

@section('title', 'Результат подбора по VIN — AVAMotors')

@push('styles')
    @vite(['resources/css/vin.css'])
@endpush

@section('content')
    <div class="vin-result-container">
        <div class="vin-result-card">
            <div class="vin-result-header">
                <h1>🔍 Результат подбора по VIN</h1>
                <div class="vin-code">{{ $vehicleData['vin'] }}</div>
            </div>

            <div class="vin-result-body">
                @php
                    // Определяем поля для отображения
                    $displayFields = [
                        'make' => 'Марка',
                        'model' => 'Модель',
                        'year' => 'Год выпуска',
                        'trim' => 'Комплектация',
                        'engine_model' => 'Двигатель',
                        'engine_cylinders' => 'Цилиндры',
                        'fuel_type' => 'Топливо',
                        'drive_type' => 'Привод',
                        'body_class' => 'Тип кузова',
                        'manufacturer' => 'Производитель',
                        'plant_country' => 'Страна сборки',
                        'plant_city' => 'Город сборки',
                        'vehicle_type' => 'Тип ТС',
                    ];

                    $hasData = false;
                @endphp

                <div class="info-grid">
                    @foreach($displayFields as $key => $label)
                        @if(isset($vehicleData[$key]) && !empty($vehicleData[$key]))
                            @php $hasData = true; @endphp
                            <div class="info-item">
                                <div class="info-label">{{ $label }}</div>
                                <div class="info-value">{{ $vehicleData[$key] }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>

                @if(!$hasData)
                    <div style="text-align: center; padding: 40px; color: #888;">
                        <p>😕 Нет доступной информации об этом автомобиле</p>
                    </div>
                @endif

                {{-- Карточка с количеством совместимых товаров и кнопкой --}}
                <div class="compatible-card">
                    <div class="compatible-count">{{ $productsCount }}</div>
                    <div class="compatible-text">совместимых запчастей найдено в каталоге</div>

                    @php
                        // Формируем URL для перехода в каталог с фильтрами
                        $catalogUrl = route('catalog');
                        $params = [];

                        if (!empty($vehicleData['make'])) {
                            $params['make'] = $vehicleData['make'];
                        }
                        if (!empty($vehicleData['model'])) {
                            $params['model'] = $vehicleData['model'];
                        }
                        if (!empty($vehicleData['trim'])) {
                            $params['search'] = $vehicleData['trim'];
                        }

                        if (!empty($params)) {
                            $catalogUrl .= '?' . http_build_query($params);
                        }
                    @endphp

                    <a href="{{ $catalogUrl }}" class="vin-btn-filter">
                        🔧 Перейти в каталог
                        <svg width="18" height="18" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M3 8h10M9 4l4 4-4 4"/>
                        </svg>
                    </a>
                </div>

                <div class="vin-actions">
                    <a href="{{ route('vin.index') }}" class="vin-btn-back">
                        ← Новый поиск
                    </a>
                    <a href="{{ route('catalog') }}" class="vin-btn-catalog">
                        Весь каталог →
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
