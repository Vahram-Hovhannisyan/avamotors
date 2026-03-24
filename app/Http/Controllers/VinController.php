<?php
// app/Http/Controllers/VinController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class VinController extends Controller
{
    public function index()
    {
        return view('vin.index');
    }

    public function decode(Request $request)
    {
        // Валидация
        $request->validate([
            'vin' => 'required|string|max:17|min:17'
        ]);

        $vin = strtoupper(trim($request->vin));
        $vin = preg_replace('/[\s\-]/', '', $vin);

        // Валидация формата VIN
        if (!$this->validateVinFormat($vin)) {
            return redirect()->back()->with('vin_error', '❌ Неверный формат VIN. VIN должен содержать ровно 17 символов. Допустимы: цифры и буквы A-Z (кроме I, O, Q).');
        }

        // Декодируем через NHTSA API
        $vehicleData = $this->decodeVinViaNhtsa($vin);

        if (!$vehicleData) {
            return redirect()->back()->with('vin_error', '❌ VIN не найден в базе данных. Проверьте правильность ввода.');
        }

        // Ищем совместимые товары по марке и модели
        $compatibleProducts = $this->findCompatibleProducts($vehicleData);
        $productsCount = $compatibleProducts->count();

        // Сохраняем в сессию для фильтрации в каталоге
        session([
            'selected_vin' => $vin,
            'selected_vehicle' => $vehicleData,
            'vin_decoded' => true,
            'compatible_products_count' => $productsCount
        ]);

        // Показываем результат с кнопкой перехода в каталог
        return view('vin.result', compact('vehicleData', 'productsCount'));
    }

    public function clear()
    {
        session()->forget([
            'selected_vin',
            'selected_vehicle',
            'vin_decoded',
            'compatible_products_count'
        ]);

        return redirect()->route('catalog')->with('success', 'Фильтр по VIN очищен');
    }

    private function validateVinFormat($vin)
    {
        return preg_match('/^[A-HJ-NPR-Z0-9]{17}$/', $vin);
    }

    private function decodeVinViaNhtsa($vin)
    {
        try {
            $response = Http::timeout(10)->get("https://vpic.nhtsa.dot.gov/api/vehicles/decodevinvalues/{$vin}", [
                'format' => 'json'
            ]);

            if (!$response->successful()) {
                return null;
            }

            $data = $response->json();
            $result = $data['Results'][0] ?? null;

            if (empty($result) || (empty($result['Make']) && empty($result['Model']))) {
                return null;
            }

            // Формируем массив с данными
            $vehicleData = [
                'vin' => $vin,
                'make' => $result['Make'] ?? null,
                'model' => $result['Model'] ?? null,
                'year' => $result['ModelYear'] ?? null,
                'trim' => $result['Trim'] ?? null,
                'engine_model' => $result['EngineModel'] ?? null,
                'engine_cylinders' => $result['EngineCylinders'] ?? null,
                'fuel_type' => $result['FuelTypePrimary'] ?? null,
                'drive_type' => $result['DriveType'] ?? null,
                'body_class' => $result['BodyClass'] ?? null,
                'manufacturer' => $result['Manufacturer'] ?? null,
                'plant_country' => $result['PlantCountry'] ?? null,
                'plant_city' => $result['PlantCity'] ?? null,
                'vehicle_type' => $result['VehicleType'] ?? null,
            ];

            // Удаляем пустые значения
            return array_filter($vehicleData, function($value) {
                return !is_null($value) && $value !== '' && $value !== 'Не определено';
            });

        } catch (\Exception $e) {
            \Log::error('VIN decode error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Поиск совместимых товаров
     * Нормализуем строки: убираем пробелы, приводим к нижнему регистру
     */
    /**
     * Поиск совместимых товаров
     * Проверяем:
     * 1. is_active = true
     * 2. brand совпадает с make из VIN
     * 3. compatible_for содержит модель и комплектацию (без пробелов, нижний регистр)
     */
    private function findCompatibleProducts($vehicleData)
    {
        // Нормализуем данные из VIN
        $make = isset($vehicleData['make']) ? $this->normalizeString($vehicleData['make']) : null;
        $model = isset($vehicleData['model']) ? $this->normalizeString($vehicleData['model']) : null;
        $trim = isset($vehicleData['trim']) ? $this->normalizeString($vehicleData['trim']) : null;

        // Создаем комбинации для поиска в compatible_for
        $searchPatterns = [];

        // Модель + Комплектация
        if ($model && $trim) {
            $searchPatterns[] = $model . $trim;
            $searchPatterns[] = $model . ' ' . $trim;
        }

        // Только модель
        if ($model) {
            $searchPatterns[] = $model;
        }

        // Только комплектация
        if ($trim) {
            $searchPatterns[] = $trim;
        }

        // Марка + Модель
        if ($make && $model) {
            $searchPatterns[] = $make . $model;
            $searchPatterns[] = $make . ' ' . $model;
        }

        // Марка + Модель + Комплектация
        if ($make && $model && $trim) {
            $searchPatterns[] = $make . $model . $trim;
            $searchPatterns[] = $make . ' ' . $model . ' ' . $trim;
        }

        // Удаляем дубликаты и пустые значения
        $searchPatterns = array_unique(array_filter($searchPatterns));

        $query = Product::query()
            ->where('is_active', true)
            ->where(function($q) use ($make, $searchPatterns) {

                // 1. Проверка по brand (должен совпадать с make из VIN)
                if ($make) {
                    $q->whereRaw("REPLACE(LOWER(brand), ' ', '') LIKE ?", ["%{$make}%"]);
                }

                // 2. Проверка по compatible_for (содержит модель и/или комплектацию)
                if (!empty($searchPatterns)) {
                    foreach ($searchPatterns as $pattern) {
                        $normalizedPattern = $this->normalizeString($pattern);

                        // Проверяем в compatible_for
                        if (\Schema::hasColumn('products', 'compatible_for')) {
                            $q->orWhereRaw("REPLACE(LOWER(compatible_for), ' ', '') LIKE ?", ["%{$normalizedPattern}%"]);
                        }

                        // Проверяем в названии товара
                        $q->orWhereRaw("REPLACE(LOWER(name), ' ', '') LIKE ?", ["%{$normalizedPattern}%"]);

                        // Проверяем в описании
                        $q->orWhereRaw("REPLACE(LOWER(description), ' ', '') LIKE ?", ["%{$normalizedPattern}%"]);
                    }
                }
            });

        // Логируем для отладки (можно убрать в продакшене)
        \Log::info('VIN Search', [
            'make' => $make,
            'model' => $model,
            'trim' => $trim,
            'patterns' => $searchPatterns,
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

        return $query->limit(50)->get();
    }

    /**
     * Нормализация строки: убираем пробелы, приводим к нижнему регистру
     */
    private function normalizeString($string)
    {
        if (empty($string)) {
            return '';
        }

        // Приводим к строке, убираем пробелы, переводим в нижний регистр
        $normalized = preg_replace('/\s+/', '', trim($string));
        $normalized = mb_strtolower($normalized);

        // Дополнительно убираем спецсимволы, оставляем только буквы и цифры
        $normalized = preg_replace('/[^a-zа-яё0-9]/u', '', $normalized);

        return $normalized;
    }
}
