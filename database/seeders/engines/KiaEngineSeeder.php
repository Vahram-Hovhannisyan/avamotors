<?php

namespace Database\Seeders\Engines;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Engine;

class KiaEngineSeeder extends Seeder
{
    public function run(): void
    {
        $kia = CarMake::where('name', 'Kia')->first();

        if (!$kia) {
            $this->command->error('Kia not found!');
            return;
        }

        $models = [
            'Rio' => CarModel::where('car_make_id', $kia->id)->where('name', 'Rio')->first(),
            'Ceed' => CarModel::where('car_make_id', $kia->id)->where('name', 'Ceed')->first(),
            'Sportage' => CarModel::where('car_make_id', $kia->id)->where('name', 'Sportage')->first(),
            'Sorento' => CarModel::where('car_make_id', $kia->id)->where('name', 'Sorento')->first(),
            'Optima' => CarModel::where('car_make_id', $kia->id)->where('name', 'Optima')->first(),
            'K5' => CarModel::where('car_make_id', $kia->id)->where('name', 'K5')->first(),
            'K7' => CarModel::where('car_make_id', $kia->id)->where('name', 'K7')->first(),
            'K9' => CarModel::where('car_make_id', $kia->id)->where('name', 'K9')->first(),
            'Picanto' => CarModel::where('car_make_id', $kia->id)->where('name', 'Picanto')->first(),
            'Soul' => CarModel::where('car_make_id', $kia->id)->where('name', 'Soul')->first(),
            'Stinger' => CarModel::where('car_make_id', $kia->id)->where('name', 'Stinger')->first(),
            'Seltos' => CarModel::where('car_make_id', $kia->id)->where('name', 'Seltos')->first(),
            'Niro' => CarModel::where('car_make_id', $kia->id)->where('name', 'Niro')->first(),
            'Telluride' => CarModel::where('car_make_id', $kia->id)->where('name', 'Telluride')->first(),
            'Carnival' => CarModel::where('car_make_id', $kia->id)->where('name', 'Carnival')->first(),
            'Forte' => CarModel::where('car_make_id', $kia->id)->where('name', 'Forte')->first(),
            'Cerato' => CarModel::where('car_make_id', $kia->id)->where('name', 'Cerato')->first(),
            'Carens' => CarModel::where('car_make_id', $kia->id)->where('name', 'Carens')->first(),
            'Mohave' => CarModel::where('car_make_id', $kia->id)->where('name', 'Mohave')->first(),
            'Stonic' => CarModel::where('car_make_id', $kia->id)->where('name', 'Stonic')->first(),
            'EV6' => CarModel::where('car_make_id', $kia->id)->where('name', 'EV6')->first(),
            'EV9' => CarModel::where('car_make_id', $kia->id)->where('name', 'EV9')->first(),
        ];

        $engines = [
            // ==================== Бензиновые двигатели серии Kappa (1.0 - 1.2) ====================
            ['car_model_id' => $models['Picanto']?->id, 'name' => '1.0L', 'code' => 'G3LA', 'displacement' => 1.0, 'horsepower' => 66, 'kw' => 49, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2020],
            ['car_model_id' => $models['Picanto']?->id, 'name' => '1.0L', 'code' => 'G3LA', 'displacement' => 1.0, 'horsepower' => 75, 'kw' => 56, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2017, 'year_to' => 2020],
            ['car_model_id' => $models['Picanto']?->id, 'name' => '1.2L', 'code' => 'G4LA', 'displacement' => 1.2, 'horsepower' => 84, 'kw' => 63, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2017],
            ['car_model_id' => $models['Stonic']?->id, 'name' => '1.0L Turbo', 'code' => 'G3LD', 'displacement' => 1.0, 'horsepower' => 100, 'kw' => 75, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Турбо', 'year_from' => 2017],
            ['car_model_id' => $models['Stonic']?->id, 'name' => '1.0L Turbo', 'code' => 'G3LD', 'displacement' => 1.0, 'horsepower' => 120, 'kw' => 89, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Турбо', 'year_from' => 2018],
            ['car_model_id' => $models['Rio']?->id, 'name' => '1.0L Turbo', 'code' => 'G3LD', 'displacement' => 1.0, 'horsepower' => 120, 'kw' => 89, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Турбо', 'year_from' => 2018],

            // ==================== Серия Gamma (1.4 - 1.6) ====================
            ['car_model_id' => $models['Rio']?->id, 'name' => '1.4L', 'code' => 'G4LC', 'displacement' => 1.4, 'horsepower' => 100, 'kw' => 75, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2011],
            ['car_model_id' => $models['Ceed']?->id, 'name' => '1.4L', 'code' => 'G4LC', 'displacement' => 1.4, 'horsepower' => 100, 'kw' => 75, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2012, 'year_to' => 2018],
            ['car_model_id' => $models['Rio']?->id, 'name' => '1.6L', 'code' => 'G4FC', 'displacement' => 1.6, 'horsepower' => 123, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2017],
            ['car_model_id' => $models['Ceed']?->id, 'name' => '1.6L', 'code' => 'G4FC', 'displacement' => 1.6, 'horsepower' => 122, 'kw' => 91, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2012],
            ['car_model_id' => $models['Soul']?->id, 'name' => '1.6L', 'code' => 'G4FC', 'displacement' => 1.6, 'horsepower' => 124, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2008, 'year_to' => 2014],
            ['car_model_id' => $models['Ceed']?->id, 'name' => '1.6L', 'code' => 'G4FG', 'displacement' => 1.6, 'horsepower' => 130, 'kw' => 97, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2012],
            ['car_model_id' => $models['Rio']?->id, 'name' => '1.6L', 'code' => 'G4FG', 'displacement' => 1.6, 'horsepower' => 123, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2017],
            ['car_model_id' => $models['Seltos']?->id, 'name' => '1.6L', 'code' => 'G4FG', 'displacement' => 1.6, 'horsepower' => 123, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2019],

            // ==================== Турбированные Gamma (1.6 T-GDI) ====================
            ['car_model_id' => $models['Ceed']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 204, 'kw' => 152, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013],
            ['car_model_id' => $models['Sportage']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 177, 'kw' => 132, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015],
            ['car_model_id' => $models['Soul']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 201, 'kw' => 150, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2014],
            ['car_model_id' => $models['K5']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 180, 'kw' => 134, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['Seltos']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 177, 'kw' => 132, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],

            // ==================== Серия Nu (1.8 - 2.0) ====================
            ['car_model_id' => $models['Forte']?->id, 'name' => '1.8L', 'code' => 'G4NB', 'displacement' => 1.8, 'horsepower' => 147, 'kw' => 110, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2013],
            ['car_model_id' => $models['K5']?->id, 'name' => '2.0L', 'code' => 'G4NA', 'displacement' => 2.0, 'horsepower' => 152, 'kw' => 113, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2015],
            ['car_model_id' => $models['Sportage']?->id, 'name' => '2.0L', 'code' => 'G4NA', 'displacement' => 2.0, 'horsepower' => 155, 'kw' => 116, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2015],
            ['car_model_id' => $models['Seltos']?->id, 'name' => '2.0L', 'code' => 'G4NA', 'displacement' => 2.0, 'horsepower' => 149, 'kw' => 111, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2019],

            // ==================== Серия Theta (2.0 - 2.4) ====================
            ['car_model_id' => $models['Optima']?->id, 'name' => '2.0L', 'code' => 'G4KD', 'displacement' => 2.0, 'horsepower' => 165, 'kw' => 123, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2010],
            ['car_model_id' => $models['Sportage']?->id, 'name' => '2.0L', 'code' => 'G4KD', 'displacement' => 2.0, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2010],
            ['car_model_id' => $models['Ceed']?->id, 'name' => '2.0L', 'code' => 'G4KD', 'displacement' => 2.0, 'horsepower' => 143, 'kw' => 107, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2012],
            ['car_model_id' => $models['Optima']?->id, 'name' => '2.4L', 'code' => 'G4KE', 'displacement' => 2.4, 'horsepower' => 172, 'kw' => 128, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2015],
            ['car_model_id' => $models['Sorento']?->id, 'name' => '2.4L', 'code' => 'G4KE', 'displacement' => 2.4, 'horsepower' => 172, 'kw' => 128, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2014],

            // ==================== Турбированные Theta (2.0 T-GDI) ====================
            ['car_model_id' => $models['Optima']?->id, 'name' => '2.0L Turbo', 'code' => 'G4KH', 'displacement' => 2.0, 'horsepower' => 245, 'kw' => 183, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2019],
            ['car_model_id' => $models['K5']?->id, 'name' => '2.0L Turbo', 'code' => 'G4KH', 'displacement' => 2.0, 'horsepower' => 245, 'kw' => 183, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['Sorento']?->id, 'name' => '2.0L Turbo', 'code' => 'G4KH', 'displacement' => 2.0, 'horsepower' => 240, 'kw' => 179, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015],
            ['car_model_id' => $models['K7']?->id, 'name' => '2.0L Turbo', 'code' => 'G4KH', 'displacement' => 2.0, 'horsepower' => 245, 'kw' => 183, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2012],

            // ==================== Smartstream (1.5 - 1.6) ====================
            ['car_model_id' => $models['K5']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FP', 'displacement' => 1.6, 'horsepower' => 180, 'kw' => 134, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['Seltos']?->id, 'name' => '1.5L', 'code' => 'G4FL', 'displacement' => 1.5, 'horsepower' => 115, 'kw' => 86, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2021],

            // ==================== V6 двигатели (Lambda) ====================
            ['car_model_id' => $models['Sorento']?->id, 'name' => '3.3L V6', 'code' => 'G6DB', 'displacement' => 3.3, 'horsepower' => 242, 'kw' => 180, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2012],
            ['car_model_id' => $models['Sorento']?->id, 'name' => '3.5L V6', 'code' => 'G6DC', 'displacement' => 3.5, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2015],
            ['car_model_id' => $models['K7']?->id, 'name' => '3.3L V6', 'code' => 'G6DB', 'displacement' => 3.3, 'horsepower' => 265, 'kw' => 198, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2012],
            ['car_model_id' => $models['K7']?->id, 'name' => '3.5L V6', 'code' => 'G6DC', 'displacement' => 3.5, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2012],
            ['car_model_id' => $models['K9']?->id, 'name' => '3.3L V6', 'code' => 'G6DJ', 'displacement' => 3.3, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2012],
            ['car_model_id' => $models['K9']?->id, 'name' => '3.8L V6', 'code' => 'G6DJ', 'displacement' => 3.8, 'horsepower' => 333, 'kw' => 248, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2012],
            ['car_model_id' => $models['Telluride']?->id, 'name' => '3.8L V6', 'code' => 'G6DN', 'displacement' => 3.8, 'horsepower' => 291, 'kw' => 217, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2019],
            ['car_model_id' => $models['Carnival']?->id, 'name' => '3.5L V6', 'code' => 'G6DC', 'displacement' => 3.5, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2020],

            // ==================== V6 Twin-Turbo (Stinger) ====================
            ['car_model_id' => $models['Stinger']?->id, 'name' => '3.3L V6 Twin-Turbo', 'code' => 'G6DP', 'displacement' => 3.3, 'horsepower' => 365, 'kw' => 272, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2017],
            ['car_model_id' => $models['Stinger']?->id, 'name' => '3.3L V6 Twin-Turbo', 'code' => 'G6DP', 'displacement' => 3.3, 'horsepower' => 370, 'kw' => 276, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2018],
            ['car_model_id' => $models['Stinger']?->id, 'name' => '2.5L Turbo', 'code' => 'G4KP', 'displacement' => 2.5, 'horsepower' => 300, 'kw' => 224, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2021],

            // ==================== Дизельные двигатели (CRDi) ====================
            ['car_model_id' => $models['Rio']?->id, 'name' => '1.4L CRDi', 'code' => 'D4FA', 'displacement' => 1.4, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2005, 'year_to' => 2011],
            ['car_model_id' => $models['Ceed']?->id, 'name' => '1.4L CRDi', 'code' => 'D4FA', 'displacement' => 1.4, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2006, 'year_to' => 2012],
            ['car_model_id' => $models['Ceed']?->id, 'name' => '1.6L CRDi', 'code' => 'D4FB', 'displacement' => 1.6, 'horsepower' => 115, 'kw' => 86, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2007, 'year_to' => 2015],
            ['car_model_id' => $models['Sportage']?->id, 'name' => '1.6L CRDi', 'code' => 'D4FB', 'displacement' => 1.6, 'horsepower' => 115, 'kw' => 86, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2007, 'year_to' => 2015],
            ['car_model_id' => $models['Soul']?->id, 'name' => '1.6L CRDi', 'code' => 'D4FB', 'displacement' => 1.6, 'horsepower' => 128, 'kw' => 95, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2014],
            ['car_model_id' => $models['Ceed']?->id, 'name' => '1.6L CRDi', 'code' => 'D4FE', 'displacement' => 1.6, 'horsepower' => 136, 'kw' => 101, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015],
            ['car_model_id' => $models['Sportage']?->id, 'name' => '2.0L CRDi', 'code' => 'D4HA', 'displacement' => 2.0, 'horsepower' => 185, 'kw' => 138, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2018],
            ['car_model_id' => $models['Sorento']?->id, 'name' => '2.0L CRDi', 'code' => 'D4HA', 'displacement' => 2.0, 'horsepower' => 185, 'kw' => 138, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2014],
            ['car_model_id' => $models['Optima']?->id, 'name' => '1.7L CRDi', 'code' => 'D4FD', 'displacement' => 1.7, 'horsepower' => 136, 'kw' => 101, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2011, 'year_to' => 2015],
            ['car_model_id' => $models['K5']?->id, 'name' => '1.7L CRDi', 'code' => 'D4FD', 'displacement' => 1.7, 'horsepower' => 141, 'kw' => 105, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2016],
            ['car_model_id' => $models['Sorento']?->id, 'name' => '2.2L CRDi', 'code' => 'D4HB', 'displacement' => 2.2, 'horsepower' => 200, 'kw' => 149, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2009],
            ['car_model_id' => $models['Carnival']?->id, 'name' => '2.2L CRDi', 'code' => 'D4HB', 'displacement' => 2.2, 'horsepower' => 200, 'kw' => 149, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010],
            ['car_model_id' => $models['Mohave']?->id, 'name' => '3.0L V6 CRDi', 'code' => 'D6EA', 'displacement' => 3.0, 'horsepower' => 250, 'kw' => 186, 'fuel_type' => 'Дизель', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2008],

            // ==================== Гибридные двигатели ====================
            ['car_model_id' => $models['Niro']?->id, 'name' => '1.6L Hybrid', 'code' => 'G4LE', 'displacement' => 1.6, 'horsepower' => 139, 'kw' => 104, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2016],
            ['car_model_id' => $models['Niro']?->id, 'name' => '1.6L Plug-in Hybrid', 'code' => 'G4LE', 'displacement' => 1.6, 'horsepower' => 141, 'kw' => 105, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2017],
            ['car_model_id' => $models['Optima']?->id, 'name' => '2.0L Hybrid', 'code' => 'G4KE', 'displacement' => 2.0, 'horsepower' => 155, 'kw' => 116, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2011],
            ['car_model_id' => $models['K5']?->id, 'name' => '2.0L Hybrid', 'code' => 'G4KE', 'displacement' => 2.0, 'horsepower' => 155, 'kw' => 116, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2019],
            ['car_model_id' => $models['Sorento']?->id, 'name' => '2.2L Hybrid', 'code' => 'D4HB', 'displacement' => 2.2, 'horsepower' => 200, 'kw' => 149, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2020],

            // ==================== Электромоторы ====================
            ['car_model_id' => $models['Soul']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 110, 'kw' => 82, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2014, 'year_to' => 2019],
            ['car_model_id' => $models['Soul']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 201, 'kw' => 150, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2019],
            ['car_model_id' => $models['Niro']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 201, 'kw' => 150, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2018],
            ['car_model_id' => $models['EV6']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 167, 'kw' => 125, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['EV6']?->id, 'name' => 'Electric AWD', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 320, 'kw' => 239, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['EV6']?->id, 'name' => 'Electric GT', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 577, 'kw' => 430, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2022],
            ['car_model_id' => $models['EV9']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 201, 'kw' => 150, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2023],
            ['car_model_id' => $models['EV9']?->id, 'name' => 'Electric AWD', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 379, 'kw' => 283, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2023],
        ];

        foreach ($engines as $engine) {
            if ($engine['car_model_id']) {
                Engine::updateOrCreate(
                    ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                    $engine
                );
            }
        }

        $this->command->info('✓ Kia engines seeded: ' . count($engines));
    }
}
