<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarMake;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $makeSearch  = trim($request->get('make_search', ''));
        $modelSearch = trim($request->get('model_search', ''));

        $makes = CarMake::withCount('carModels')
            ->when($makeSearch, fn($q) => $q->where('name', 'like', "%{$makeSearch}%"))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $models = CarModel::with('carMake')
            ->when($modelSearch, fn($q) => $q->where('name', 'like', "%{$modelSearch}%")
                ->orWhereHas('carMake', fn($q2) => $q2->where('name', 'like', "%{$modelSearch}%")))
            ->orderBy('car_make_id')
            ->paginate(10, ['*'], 'models_page')
            ->withQueryString();

        $allMakes = CarMake::orderBy('name')->get();

        return view('admin.cars.index', compact('makes', 'models', 'allMakes', 'makeSearch', 'modelSearch'));
    }

    public function storeMake(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:car_makes,name'],
        ]);

        CarMake::create($data);

        return back()->with('success', "Марка «{$data['name']}» добавлена.");
    }

    public function destroyMake(CarMake $carMake)
    {
        if ($carMake->carModels()->exists()) {
            return back()->withErrors(['error' => 'Нельзя удалить марку с моделями.']);
        }

        $name = $carMake->name;
        $carMake->delete();

        return back()->with('success', "Марка «{$name}» удалена.");
    }

    public function storeModel(Request $request)
    {
        $request->validate([
            'car_make_id' => ['required', 'exists:car_makes,id'],
            'names'       => ['required', 'array', 'min:1'],
            'names.*'     => ['required', 'string', 'max:100'],
        ]);

        $makeId  = $request->car_make_id;
        $added   = [];
        $skipped = [];

        foreach ($request->names as $name) {
            $name = trim($name);
            if ($name === '') continue;

            $exists = CarModel::where('car_make_id', $makeId)->where('name', $name)->exists();

            if ($exists) {
                $skipped[] = $name;
            } else {
                CarModel::create(['car_make_id' => $makeId, 'name' => $name]);
                $added[] = $name;
            }
        }

        if (empty($added)) {
            return back()->withErrors(['names' => 'Все указанные модели уже существуют для этой марки.']);
        }

        $message = 'Добавлено: ' . implode(', ', $added) . '.';
        if (!empty($skipped)) {
            $message .= ' Пропущено (уже есть): ' . implode(', ', $skipped) . '.';
        }

        return back()->with('success', $message);
    }

    public function destroyModel(CarModel $carModel)
    {
        if ($carModel->products()->exists()) {
            return back()->withErrors(['error' => 'Нельзя удалить модель, привязанную к товарам.']);
        }

        $name = $carModel->name;
        $carModel->delete();

        return back()->with('success', "Модель «{$name}» удалена.");
    }
}
