<?php

namespace Database\Seeders\Engines;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Engine;

class NissanEngineSeeder extends Seeder
{
    public function run(): void
    {
        $nissan = CarMake::where('name', 'Nissan')->first();

        if (!$nissan) {
            $this->command->error('Nissan not found!');
            return;
        }

        $models = [
            'Qashqai' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Qashqai')->first(),
            'X-Trail' => CarModel::where('car_make_id', $nissan->id)->where('name', 'X-Trail')->first(),
            'Pathfinder' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Pathfinder')->first(),
            'Patrol' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Patrol')->first(),
            'Navara' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Navara')->first(),
            'Juke' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Juke')->first(),
            'Micra' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Micra')->first(),
            'Note' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Note')->first(),
            'Almera' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Almera')->first(),
            'Primera' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Primera')->first(),
            'Altima' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Altima')->first(),
            'Maxima' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Maxima')->first(),
            'Sentra' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Sentra')->first(),
            'GT-R' => CarModel::where('car_make_id', $nissan->id)->where('name', 'GT-R')->first(),
            'Fairlady Z' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Fairlady Z')->first(),
            '370Z' => CarModel::where('car_make_id', $nissan->id)->where('name', '370Z')->first(),
            'Skyline' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Skyline')->first(),
            'Leaf' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Leaf')->first(),
            'Murano' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Murano')->first(),
            'Teana' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Teana')->first(),
            'Tiida' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Tiida')->first(),
            'Cube' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Cube')->first(),
            'Elgrand' => CarModel::where('car_make_id', $nissan->id)->where('name', 'Elgrand')->first(),
        ];

        $engines = [
            // ==================== Бензиновые двигатели ====================

            // Серия HR (1.0 - 1.6)
            ['car_model_id' => $models['Micra']?->id, 'name' => '1.0L', 'code' => 'HR10DE', 'displacement' => 1.0, 'horsepower' => 68, 'kw' => 51, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2010],
            ['car_model_id' => $models['Micra']?->id, 'name' => '1.2L', 'code' => 'HR12DE', 'displacement' => 1.2, 'horsepower' => 80, 'kw' => 60, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2010],
            ['car_model_id' => $models['Note']?->id, 'name' => '1.2L DIG-S', 'code' => 'HR12DDR', 'displacement' => 1.2, 'horsepower' => 98, 'kw' => 73, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Компрессор', 'year_from' => 2011],
            ['car_model_id' => $models['Juke']?->id, 'name' => '1.6L', 'code' => 'HR16DE', 'displacement' => 1.6, 'horsepower' => 117, 'kw' => 87, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010],
            ['car_model_id' => $models['Qashqai']?->id, 'name' => '1.6L', 'code' => 'HR16DE', 'displacement' => 1.6, 'horsepower' => 114, 'kw' => 85, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2013],
            ['car_model_id' => $models['Note']?->id, 'name' => '1.6L', 'code' => 'HR16DE', 'displacement' => 1.6, 'horsepower' => 110, 'kw' => 82, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005],

            // Серия MR (1.6 - 2.0)
            ['car_model_id' => $models['Qashqai']?->id, 'name' => '1.2L DIG-T', 'code' => 'HRA2DDT', 'displacement' => 1.2, 'horsepower' => 115, 'kw' => 86, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013, 'year_to' => 2021],
            ['car_model_id' => $models['Qashqai']?->id, 'name' => '1.3L DIG-T', 'code' => 'HR13DDT', 'displacement' => 1.3, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2018],
            ['car_model_id' => $models['Juke']?->id, 'name' => '1.6L DIG-T', 'code' => 'MR16DDT', 'displacement' => 1.6, 'horsepower' => 190, 'kw' => 142, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2019],
            ['car_model_id' => $models['X-Trail']?->id, 'name' => '2.0L', 'code' => 'MR20DE', 'displacement' => 2.0, 'horsepower' => 141, 'kw' => 105, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2013],
            ['car_model_id' => $models['X-Trail']?->id, 'name' => '2.0L Hybrid', 'code' => 'MR20DDT', 'displacement' => 2.0, 'horsepower' => 147, 'kw' => 110, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2013, 'year_to' => 2021],
            ['car_model_id' => $models['Qashqai']?->id, 'name' => '2.0L', 'code' => 'MR20DE', 'displacement' => 2.0, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2013],

            // Серия QR (2.0 - 2.5)
            ['car_model_id' => $models['Altima']?->id, 'name' => '2.5L', 'code' => 'QR25DE', 'displacement' => 2.5, 'horsepower' => 175, 'kw' => 130, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2012],
            ['car_model_id' => $models['X-Trail']?->id, 'name' => '2.5L', 'code' => 'QR25DE', 'displacement' => 2.5, 'horsepower' => 169, 'kw' => 126, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2013],
            ['car_model_id' => $models['Navara']?->id, 'name' => '2.5L', 'code' => 'QR25DE', 'displacement' => 2.5, 'horsepower' => 152, 'kw' => 113, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2015],
            ['car_model_id' => $models['Sentra']?->id, 'name' => '2.5L', 'code' => 'QR25DE', 'displacement' => 2.5, 'horsepower' => 177, 'kw' => 132, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007],

            // Серия SR (1.6 - 2.0) - спортивные
            ['car_model_id' => $models['Primera']?->id, 'name' => '2.0L', 'code' => 'SR20DE', 'displacement' => 2.0, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2002],
            ['car_model_id' => $models['Almera']?->id, 'name' => '2.0L', 'code' => 'SR20DE', 'displacement' => 2.0, 'horsepower' => 143, 'kw' => 107, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1998, 'year_to' => 2006],
            ['car_model_id' => $models['Skyline']?->id, 'name' => '2.0L Turbo', 'code' => 'SR20DET', 'displacement' => 2.0, 'horsepower' => 205, 'kw' => 153, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 1991, 'year_to' => 2002],

            // Серия VQ V6 (2.5 - 4.0)
            ['car_model_id' => $models['Maxima']?->id, 'name' => '3.5L V6', 'code' => 'VQ35DE', 'displacement' => 3.5, 'horsepower' => 265, 'kw' => 198, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2008],
            ['car_model_id' => $models['Maxima']?->id, 'name' => '3.5L V6', 'code' => 'VQ35HR', 'displacement' => 3.5, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2014],
            ['car_model_id' => $models['Altima']?->id, 'name' => '3.5L V6', 'code' => 'VQ35DE', 'displacement' => 3.5, 'horsepower' => 270, 'kw' => 201, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2012],
            ['car_model_id' => $models['Pathfinder']?->id, 'name' => '3.5L V6', 'code' => 'VQ35DE', 'displacement' => 3.5, 'horsepower' => 240, 'kw' => 179, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2012],
            ['car_model_id' => $models['Pathfinder']?->id, 'name' => '4.0L V6', 'code' => 'VQ40DE', 'displacement' => 4.0, 'horsepower' => 266, 'kw' => 198, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2012],
            ['car_model_id' => $models['Murano']?->id, 'name' => '3.5L V6', 'code' => 'VQ35DE', 'displacement' => 3.5, 'horsepower' => 260, 'kw' => 194, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2014],
            ['car_model_id' => $models['Teana']?->id, 'name' => '2.5L V6', 'code' => 'VQ25DE', 'displacement' => 2.5, 'horsepower' => 185, 'kw' => 138, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2012],
            ['car_model_id' => $models['Teana']?->id, 'name' => '3.5L V6', 'code' => 'VQ35DE', 'displacement' => 3.5, 'horsepower' => 250, 'kw' => 186, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2012],

            // Спортивные V6
            ['car_model_id' => $models['370Z']?->id, 'name' => '3.7L V6', 'code' => 'VQ37VHR', 'displacement' => 3.7, 'horsepower' => 328, 'kw' => 245, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2008, 'year_to' => 2020],
            ['car_model_id' => $models['Fairlady Z']?->id, 'name' => '3.7L V6', 'code' => 'VQ37VHR', 'displacement' => 3.7, 'horsepower' => 328, 'kw' => 245, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2008],
            ['car_model_id' => $models['Skyline']?->id, 'name' => '3.5L V6', 'code' => 'VQ35HR', 'displacement' => 3.5, 'horsepower' => 306, 'kw' => 228, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2006],

            // GT-R
            ['car_model_id' => $models['GT-R']?->id, 'name' => '3.8L V6 Twin-Turbo', 'code' => 'VR38DETT', 'displacement' => 3.8, 'horsepower' => 480, 'kw' => 358, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2007, 'year_to' => 2011],
            ['car_model_id' => $models['GT-R']?->id, 'name' => '3.8L V6 Twin-Turbo', 'code' => 'VR38DETT', 'displacement' => 3.8, 'horsepower' => 530, 'kw' => 395, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2012, 'year_to' => 2016],
            ['car_model_id' => $models['GT-R']?->id, 'name' => '3.8L V6 Twin-Turbo', 'code' => 'VR38DETT', 'displacement' => 3.8, 'horsepower' => 565, 'kw' => 421, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2017, 'year_to' => 2020],
            ['car_model_id' => $models['GT-R']?->id, 'name' => '3.8L V6 Twin-Turbo', 'code' => 'VR38DETT', 'displacement' => 3.8, 'horsepower' => 600, 'kw' => 447, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2021],

            // Серия VK V8
            ['car_model_id' => $models['Patrol']?->id, 'name' => '4.8L V6', 'code' => 'TB48DE', 'displacement' => 4.8, 'horsepower' => 245, 'kw' => 183, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2010],
            ['car_model_id' => $models['Patrol']?->id, 'name' => '4.5L V8', 'code' => 'VK45DE', 'displacement' => 4.5, 'horsepower' => 280, 'kw' => 209, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => 2019],
            ['car_model_id' => $models['Patrol']?->id, 'name' => '5.6L V8', 'code' => 'VK56VD', 'displacement' => 5.6, 'horsepower' => 400, 'kw' => 298, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2010],
            ['car_model_id' => $models['Patrol']?->id, 'name' => '5.6L V8', 'code' => 'VK56DE', 'displacement' => 5.6, 'horsepower' => 317, 'kw' => 236, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2010],
            ['car_model_id' => $models['Pathfinder']?->id, 'name' => '5.6L V8', 'code' => 'VK56DE', 'displacement' => 5.6, 'horsepower' => 310, 'kw' => 231, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2008, 'year_to' => 2012],

            // ==================== Дизельные двигатели ====================

            // Серия K9K (1.5 dCi)
            ['car_model_id' => $models['Qashqai']?->id, 'name' => '1.5L dCi', 'code' => 'K9K', 'displacement' => 1.5, 'horsepower' => 110, 'kw' => 82, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2007, 'year_to' => 2021],
            ['car_model_id' => $models['Juke']?->id, 'name' => '1.5L dCi', 'code' => 'K9K', 'displacement' => 1.5, 'horsepower' => 110, 'kw' => 82, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2019],
            ['car_model_id' => $models['Micra']?->id, 'name' => '1.5L dCi', 'code' => 'K9K', 'displacement' => 1.5, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2003, 'year_to' => 2010],
            ['car_model_id' => $models['Note']?->id, 'name' => '1.5L dCi', 'code' => 'K9K', 'displacement' => 1.5, 'horsepower' => 86, 'kw' => 64, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2005, 'year_to' => 2012],
            ['car_model_id' => $models['Almera']?->id, 'name' => '1.5L dCi', 'code' => 'K9K', 'displacement' => 1.5, 'horsepower' => 82, 'kw' => 61, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2003, 'year_to' => 2006],

            // Серия R9M (1.6 dCi)
            ['car_model_id' => $models['X-Trail']?->id, 'name' => '1.6L dCi', 'code' => 'R9M', 'displacement' => 1.6, 'horsepower' => 130, 'kw' => 96, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013],
            ['car_model_id' => $models['Qashqai']?->id, 'name' => '1.6L dCi', 'code' => 'R9M', 'displacement' => 1.6, 'horsepower' => 130, 'kw' => 96, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013],

            // Серия YD (2.5 dCi)
            ['car_model_id' => $models['Navara']?->id, 'name' => '2.5L dCi', 'code' => 'YD25DDTi', 'displacement' => 2.5, 'horsepower' => 163, 'kw' => 122, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2005, 'year_to' => 2015],
            ['car_model_id' => $models['Navara']?->id, 'name' => '2.5L dCi', 'code' => 'YD25DDTi', 'displacement' => 2.5, 'horsepower' => 190, 'kw' => 142, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015],
            ['car_model_id' => $models['Pathfinder']?->id, 'name' => '2.5L dCi', 'code' => 'YD25DDTi', 'displacement' => 2.5, 'horsepower' => 171, 'kw' => 128, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2004, 'year_to' => 2012],
            ['car_model_id' => $models['X-Trail']?->id, 'name' => '2.5L dCi', 'code' => 'YD25DDTi', 'displacement' => 2.5, 'horsepower' => 144, 'kw' => 107, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2006, 'year_to' => 2013],

            // Серия ZD (3.0 dCi)
            ['car_model_id' => $models['Patrol']?->id, 'name' => '3.0L dCi', 'code' => 'ZD30DDTi', 'displacement' => 3.0, 'horsepower' => 160, 'kw' => 119, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2000, 'year_to' => 2010],
            ['car_model_id' => $models['Patrol']?->id, 'name' => '3.0L dCi', 'code' => 'ZD30DDTi', 'displacement' => 3.0, 'horsepower' => 190, 'kw' => 142, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2005, 'year_to' => 2010],
            ['car_model_id' => $models['Navara']?->id, 'name' => '3.0L dCi', 'code' => 'V9X', 'displacement' => 3.0, 'horsepower' => 231, 'kw' => 172, 'fuel_type' => 'Дизель', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2015],
            ['car_model_id' => $models['Pathfinder']?->id, 'name' => '3.0L dCi', 'code' => 'V9X', 'displacement' => 3.0, 'horsepower' => 235, 'kw' => 175, 'fuel_type' => 'Дизель', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2014],

            // Серия TD (старые дизели)
            ['car_model_id' => $models['Patrol']?->id, 'name' => '4.2L Diesel', 'code' => 'TD42', 'displacement' => 4.2, 'horsepower' => 116, 'kw' => 87, 'fuel_type' => 'Дизель', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 1988, 'year_to' => 2006],
            ['car_model_id' => $models['Patrol']?->id, 'name' => '4.2L Turbo Diesel', 'code' => 'TD42T', 'displacement' => 4.2, 'horsepower' => 145, 'kw' => 108, 'fuel_type' => 'Дизель', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 1995, 'year_to' => 2004],
            ['car_model_id' => $models['Navara']?->id, 'name' => '2.7L Diesel', 'code' => 'TD27', 'displacement' => 2.7, 'horsepower' => 85, 'kw' => 63, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1985, 'year_to' => 1997],


            // Серия QG (старые бензиновые)
            ['car_model_id' => $models['Almera']?->id, 'name' => '1.5L', 'code' => 'QG15DE', 'displacement' => 1.5, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2006],
            ['car_model_id' => $models['Almera']?->id, 'name' => '1.8L', 'code' => 'QG18DE', 'displacement' => 1.8, 'horsepower' => 116, 'kw' => 87, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2006],
            ['car_model_id' => $models['Primera']?->id, 'name' => '1.6L', 'code' => 'QG16DE', 'displacement' => 1.6, 'horsepower' => 109, 'kw' => 81, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2002],
            ['car_model_id' => $models['Primera']?->id, 'name' => '1.8L', 'code' => 'QG18DE', 'displacement' => 1.8, 'horsepower' => 116, 'kw' => 87, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2002],

            // Серия GA
            ['car_model_id' => $models['Almera']?->id, 'name' => '1.4L', 'code' => 'GA14DE', 'displacement' => 1.4, 'horsepower' => 87, 'kw' => 65, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1995, 'year_to' => 2000],
            ['car_model_id' => $models['Almera']?->id, 'name' => '1.6L', 'code' => 'GA16DE', 'displacement' => 1.6, 'horsepower' => 102, 'kw' => 76, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1995, 'year_to' => 2000],

            // Серия CA
            ['car_model_id' => $models['Skyline']?->id, 'name' => '1.8L Turbo', 'code' => 'CA18DET', 'displacement' => 1.8, 'horsepower' => 169, 'kw' => 126, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 1985, 'year_to' => 1991],

            // Серия RB (легендарная рядная шестерка)
            ['car_model_id' => $models['Skyline']?->id, 'name' => '2.0L Turbo', 'code' => 'RB20DET', 'displacement' => 2.0, 'horsepower' => 212, 'kw' => 158, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 1985, 'year_to' => 1993],
            ['car_model_id' => $models['Skyline']?->id, 'name' => '2.5L', 'code' => 'RB25DE', 'displacement' => 2.5, 'horsepower' => 197, 'kw' => 147, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 1993, 'year_to' => 1998],
            ['car_model_id' => $models['Skyline']?->id, 'name' => '2.5L Turbo', 'code' => 'RB25DET', 'displacement' => 2.5, 'horsepower' => 250, 'kw' => 186, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 1993, 'year_to' => 2002],
            ['car_model_id' => $models['Skyline']?->id, 'name' => '2.6L Twin-Turbo', 'code' => 'RB26DETT', 'displacement' => 2.6, 'horsepower' => 280, 'kw' => 209, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 1989, 'year_to' => 2002],
        ];

        foreach ($engines as $engine) {
            if ($engine['car_model_id']) {
                Engine::updateOrCreate(
                    ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                    $engine
                );
            }
        }

        $this->command->info('✓ Nissan engines seeded: ' . count($engines));
    }
}
