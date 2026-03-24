<?php
// app/Http/Controllers/Admin/EngineController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Engine;
use Illuminate\Http\Request;

class EngineController extends Controller
{
    /**
     * Display a listing of engines.
     */
    public function index(Request $request)
    {
        $query = Engine::with('carModel.carMake');

        // Filter by make
        if ($request->filled('make')) {
            $query->whereHas('carModel.carMake', function($q) use ($request) {
                $q->where('id', $request->make);
            });
        }

        // Filter by model
        if ($request->filled('model')) {
            $query->where('car_model_id', $request->model);
        }

        // Filter by fuel type
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Search by name or code
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('code', 'LIKE', "%{$search}%");
            });
        }

        $engines = $query->orderBy('car_model_id')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        $carMakes = CarMake::with('carModels')->orderBy('name')->get();

        $fuelTypes = Engine::distinct()->pluck('fuel_type')->filter();

        return view('admin.engines.index', compact('engines', 'carMakes', 'fuelTypes'));
    }

    /**
     * Show the form for creating a new engine.
     */
    public function create()
    {
        $carMakes = CarMake::with('carModels')->orderBy('name')->get();
        $fuelTypes = [
            'Бензин',
            'Дизель',
            'Гибрид',
            'Электро',
            'Газ',
            'Водород'
        ];

        return view('admin.engines.create', compact('carMakes', 'fuelTypes'));
    }

    /**
     * Store a newly created engine in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'displacement' => 'nullable|numeric|min:0|max:20',
            'horsepower' => 'nullable|integer|min:0|max:2000',
            'kw' => 'nullable|integer|min:0|max:1500',
            'fuel_type' => 'nullable|string|max:50',
            'cylinders' => 'nullable|integer|min:0|max:16',
            'valves' => 'nullable|string|max:50',
            'fuel_system' => 'nullable|string|max:100',
            'turbo' => 'nullable|string|max:50',
            'year_from' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
            'year_to' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        // Check if engine with same code and model exists
        if (!empty($validated['code'])) {
            $exists = Engine::where('car_model_id', $validated['car_model_id'])
                ->where('code', $validated['code'])
                ->exists();

            if ($exists) {
                return back()->with('error', 'Двигатель с таким кодом уже существует для этой модели')
                    ->withInput();
            }
        }

        Engine::create($validated);

        return redirect()->route('admin.engines.index')
            ->with('success', 'Двигатель успешно добавлен');
    }

    /**
     * Show the form for editing the specified engine.
     */
    public function edit(Engine $engine)
    {
        $carMakes = CarMake::with('carModels')->orderBy('name')->get();
        $fuelTypes = [
            'Бензин',
            'Дизель',
            'Гибрид',
            'Электро',
            'Газ',
            'Водород'
        ];

        return view('admin.engines.edit', compact('engine', 'carMakes', 'fuelTypes'));
    }

    /**
     * Update the specified engine in storage.
     */
    public function update(Request $request, Engine $engine)
    {
        $validated = $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'displacement' => 'nullable|numeric|min:0|max:20',
            'horsepower' => 'nullable|integer|min:0|max:2000',
            'kw' => 'nullable|integer|min:0|max:1500',
            'fuel_type' => 'nullable|string|max:50',
            'cylinders' => 'nullable|integer|min:0|max:16',
            'valves' => 'nullable|string|max:50',
            'fuel_system' => 'nullable|string|max:100',
            'turbo' => 'nullable|string|max:50',
            'year_from' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
            'year_to' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        // Check if engine with same code and model exists (excluding current)
        if (!empty($validated['code'])) {
            $exists = Engine::where('car_model_id', $validated['car_model_id'])
                ->where('code', $validated['code'])
                ->where('id', '!=', $engine->id)
                ->exists();

            if ($exists) {
                return back()->with('error', 'Двигатель с таким кодом уже существует для этой модели')
                    ->withInput();
            }
        }

        $engine->update($validated);

        return redirect()->route('admin.engines.index')
            ->with('success', 'Двигатель успешно обновлен');
    }

    /**
     * Remove the specified engine from storage.
     */
    public function destroy(Engine $engine)
    {
        // Check if engine is used in any products
        $productCount = $engine->products()->count();

        if ($productCount > 0) {
            return redirect()->route('admin.engines.index')
                ->with('error', "Невозможно удалить двигатель. Он используется в {$productCount} товаре(ах).");
        }

        $engine->delete();

        return redirect()->route('admin.engines.index')
            ->with('success', 'Двигатель успешно удален');
    }

    /**
     * Get models by make ID (for AJAX requests).
     */
    public function getModelsByMake(Request $request)
    {
        $models = CarModel::where('car_make_id', $request->make_id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($models);
    }

    /**
     * Export engines to CSV.
     */
    public function export()
    {
        $engines = Engine::with('carModel.carMake')->get();

        $filename = 'engines_' . date('Y-m-d') . '.csv';
        $handle = fopen('php://temp', 'w+');

        // Headers
        fputcsv($handle, [
            'ID', 'Марка', 'Модель', 'Двигатель', 'Код', 'Объем (L)',
            'Мощность (л.с.)', 'Мощность (кВт)', 'Топливо', 'Цилиндры',
            'Клапаны', 'Топливная система', 'Турбо', 'Год от', 'Год до'
        ]);

        // Data
        foreach ($engines as $engine) {
            fputcsv($handle, [
                $engine->id,
                $engine->carModel->carMake->name ?? '-',
                $engine->carModel->name ?? '-',
                $engine->name,
                $engine->code ?? '-',
                $engine->displacement ?? '-',
                $engine->horsepower ?? '-',
                $engine->kw ?? '-',
                $engine->fuel_type ?? '-',
                $engine->cylinders ?? '-',
                $engine->valves ?? '-',
                $engine->fuel_system ?? '-',
                $engine->turbo ?? '-',
                $engine->year_from ?? '-',
                $engine->year_to ?? '-',
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename={$filename}");
    }

    /**
     * Bulk import engines from CSV.
     */
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getPathname(), 'r');

        $headers = fgetcsv($handle);
        $imported = 0;
        $errors = [];

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($headers, $row);

            // Find car model by name and make
            $carModel = null;
            if (isset($data['Марка']) && isset($data['Модель'])) {
                $carMake = CarMake::where('name', 'LIKE', "%{$data['Марка']}%")->first();
                if ($carMake) {
                    $carModel = CarModel::where('car_make_id', $carMake->id)
                        ->where('name', 'LIKE', "%{$data['Модель']}%")
                        ->first();
                }
            }

            if (!$carModel) {
                $errors[] = "Не найдена модель: {$data['Марка']} {$data['Модель']}";
                continue;
            }

            try {
                Engine::updateOrCreate(
                    [
                        'car_model_id' => $carModel->id,
                        'code' => $data['Код'] ?? null,
                    ],
                    [
                        'name' => $data['Двигатель'] ?? 'Unknown',
                        'code' => $data['Код'] ?? null,
                        'displacement' => $data['Объем (L)'] ?? null,
                        'horsepower' => $data['Мощность (л.с.)'] ?? null,
                        'kw' => $data['Мощность (кВт)'] ?? null,
                        'fuel_type' => $data['Топливо'] ?? null,
                        'cylinders' => $data['Цилиндры'] ?? null,
                        'valves' => $data['Клапаны'] ?? null,
                        'fuel_system' => $data['Топливная система'] ?? null,
                        'turbo' => $data['Турбо'] ?? null,
                        'year_from' => $data['Год от'] ?? null,
                        'year_to' => $data['Год до'] ?? null,
                    ]
                );
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Ошибка импорта: {$e->getMessage()}";
            }
        }

        fclose($handle);

        $message = "Импортировано двигателей: {$imported}";
        if (count($errors) > 0) {
            $message .= ". Ошибок: " . count($errors);
            return back()->with('warning', $message)->with('import_errors', $errors);
        }

        return redirect()->route('admin.engines.index')
            ->with('success', $message);
    }
}
