<?php

namespace Database\Seeders\Engines;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Engine;

class MercedesBenzEngineSeeder extends Seeder
{
    public function run(): void
    {
        $mercedes = CarMake::where('name', 'Mercedes-Benz')->first();

        if (!$mercedes) {
            $this->command->error('Mercedes-Benz not found!');
            return;
        }

        $models = [
            // A-Class
            'A 180' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'A 180')->first(),
            'A 200' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'A 200')->first(),
            'A 220' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'A 220')->first(),
            'A 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'A 250')->first(),
            'A 35 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'A 35 AMG')->first(),
            'A 45 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'A 45 AMG')->first(),

            // B-Class
            'B 180' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'B 180')->first(),
            'B 200' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'B 200')->first(),
            'B 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'B 250')->first(),

            // C-Class
            'C 180' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'C 180')->first(),
            'C 200' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'C 200')->first(),
            'C 220' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'C 220')->first(),
            'C 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'C 250')->first(),
            'C 300' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'C 300')->first(),
            'C 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'C 350')->first(),
            'C 43 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'C 43 AMG')->first(),
            'C 63 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'C 63 AMG')->first(),

            // E-Class
            'E 200' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'E 200')->first(),
            'E 220' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'E 220')->first(),
            'E 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'E 250')->first(),
            'E 300' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'E 300')->first(),
            'E 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'E 350')->first(),
            'E 400' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'E 400')->first(),
            'E 450' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'E 450')->first(),
            'E 53 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'E 53 AMG')->first(),
            'E 63 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'E 63 AMG')->first(),

            // S-Class
            'S 320' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'S 320')->first(),
            'S 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'S 350')->first(),
            'S 400' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'S 400')->first(),
            'S 450' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'S 450')->first(),
            'S 500' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'S 500')->first(),
            'S 560' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'S 560')->first(),
            'S 580' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'S 580')->first(),
            'S 63 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'S 63 AMG')->first(),
            'S 65 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'S 65 AMG')->first(),

            // GLA-Class
            'GLA 200' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLA 200')->first(),
            'GLA 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLA 250')->first(),
            'GLA 35 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLA 35 AMG')->first(),
            'GLA 45 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLA 45 AMG')->first(),

            // GLB-Class
            'GLB 200' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLB 200')->first(),
            'GLB 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLB 250')->first(),
            'GLB 35 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLB 35 AMG')->first(),

            // GLC-Class
            'GLC 200' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLC 200')->first(),
            'GLC 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLC 250')->first(),
            'GLC 300' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLC 300')->first(),
            'GLC 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLC 350')->first(),
            'GLC 43 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLC 43 AMG')->first(),
            'GLC 63 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLC 63 AMG')->first(),

            // GLE-Class
            'GLE 300' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLE 300')->first(),
            'GLE 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLE 350')->first(),
            'GLE 400' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLE 400')->first(),
            'GLE 450' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLE 450')->first(),
            'GLE 53 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLE 53 AMG')->first(),
            'GLE 63 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLE 63 AMG')->first(),

            // GLS-Class
            'GLS 400' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLS 400')->first(),
            'GLS 450' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLS 450')->first(),
            'GLS 500' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLS 500')->first(),
            'GLS 580' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLS 580')->first(),
            'GLS 600 Maybach' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLS 600 Maybach')->first(),

            // G-Class
            'G 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'G 350')->first(),
            'G 400' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'G 400')->first(),
            'G 500' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'G 500')->first(),
            'G 550' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'G 550')->first(),
            'G 63 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'G 63 AMG')->first(),
            'G 65 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'G 65 AMG')->first(),

            // CLS-Class
            'CLS 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'CLS 350')->first(),
            'CLS 400' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'CLS 400')->first(),
            'CLS 450' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'CLS 450')->first(),
            'CLS 500' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'CLS 500')->first(),
            'CLS 53 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'CLS 53 AMG')->first(),
            'CLS 63 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'CLS 63 AMG')->first(),

            // CLA-Class
            'CLA 200' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'CLA 200')->first(),
            'CLA 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'CLA 250')->first(),
            'CLA 35 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'CLA 35 AMG')->first(),
            'CLA 45 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'CLA 45 AMG')->first(),

            // AMG GT
            'AMG GT' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'AMG GT')->first(),
            'AMG GT 43' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'AMG GT 43')->first(),
            'AMG GT 53' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'AMG GT 53')->first(),
            'AMG GT 63' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'AMG GT 63')->first(),
            'AMG GT R' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'AMG GT R')->first(),

            // EQ Series
            'EQA 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQA 250')->first(),
            'EQB 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQB 250')->first(),
            'EQB 300' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQB 300')->first(),
            'EQB 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQB 350')->first(),
            'EQC 400' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQC 400')->first(),
            'EQE 300' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQE 300')->first(),
            'EQE 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQE 350')->first(),
            'EQE 500' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQE 500')->first(),
            'EQE 53 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQE 53 AMG')->first(),
            'EQS 450' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQS 450')->first(),
            'EQS 580' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQS 580')->first(),
            'EQS 680 Maybach' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQS 680 Maybach')->first(),
            'EQV 300' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'EQV 300')->first(),

            // V-Class
            'V 220' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'V 220')->first(),
            'V 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'V 250')->first(),
            'V 300' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'V 300')->first(),

            // ML-Class
            'ML 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'ML 250')->first(),
            'ML 320' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'ML 320')->first(),
            'ML 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'ML 350')->first(),
            'ML 400' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'ML 400')->first(),
            'ML 500' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'ML 500')->first(),
            'ML 63 AMG' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'ML 63 AMG')->first(),

            // GLK-Class
            'GLK 200' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLK 200')->first(),
            'GLK 220' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLK 220')->first(),
            'GLK 250' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLK 250')->first(),
            'GLK 300' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLK 300')->first(),
            'GLK 350' => CarModel::where('car_make_id', $mercedes->id)->where('name', 'GLK 350')->first(),
        ];

        $engines = [
            // ==================== M270/M274 (4-цилиндровые бензиновые) ====================
            ['car_model_id' => $models['A 180']?->id, 'name' => '1.6L Turbo', 'code' => 'M270 DE16', 'displacement' => 1.6, 'horsepower' => 122, 'kw' => 90, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2012, 'year_to' => 2018],
            ['car_model_id' => $models['A 200']?->id, 'name' => '1.6L Turbo', 'code' => 'M270 DE16', 'displacement' => 1.6, 'horsepower' => 156, 'kw' => 115, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2012, 'year_to' => 2018],
            ['car_model_id' => $models['A 250']?->id, 'name' => '2.0L Turbo', 'code' => 'M270 DE20', 'displacement' => 2.0, 'horsepower' => 211, 'kw' => 155, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2012, 'year_to' => 2018],
            ['car_model_id' => $models['C 180']?->id, 'name' => '1.6L Turbo', 'code' => 'M274 DE16', 'displacement' => 1.6, 'horsepower' => 156, 'kw' => 115, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2014, 'year_to' => 2018],
            ['car_model_id' => $models['C 200']?->id, 'name' => '2.0L Turbo', 'code' => 'M274 DE20', 'displacement' => 2.0, 'horsepower' => 184, 'kw' => 135, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2014, 'year_to' => 2018],
            ['car_model_id' => $models['C 250']?->id, 'name' => '2.0L Turbo', 'code' => 'M274 DE20', 'displacement' => 2.0, 'horsepower' => 211, 'kw' => 155, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2014, 'year_to' => 2018],
            ['car_model_id' => $models['C 300']?->id, 'name' => '2.0L Turbo', 'code' => 'M274 DE20', 'displacement' => 2.0, 'horsepower' => 245, 'kw' => 180, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => 2021],
            ['car_model_id' => $models['E 200']?->id, 'name' => '2.0L Turbo', 'code' => 'M274 DE20', 'displacement' => 2.0, 'horsepower' => 184, 'kw' => 135, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2016, 'year_to' => 2020],
            ['car_model_id' => $models['E 250']?->id, 'name' => '2.0L Turbo', 'code' => 'M274 DE20', 'displacement' => 2.0, 'horsepower' => 211, 'kw' => 155, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2016, 'year_to' => 2020],
            ['car_model_id' => $models['GLC 250']?->id, 'name' => '2.0L Turbo', 'code' => 'M274 DE20', 'displacement' => 2.0, 'horsepower' => 211, 'kw' => 155, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => 2019],
            ['car_model_id' => $models['GLC 300']?->id, 'name' => '2.0L Turbo', 'code' => 'M274 DE20', 'displacement' => 2.0, 'horsepower' => 245, 'kw' => 180, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019, 'year_to' => 2022],

            // ==================== M260/M264 (новые 4-цилиндровые) ====================
            ['car_model_id' => $models['A 200']?->id, 'name' => '1.3L Turbo', 'code' => 'M282 DE14', 'displacement' => 1.3, 'horsepower' => 163, 'kw' => 120, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2018],
            ['car_model_id' => $models['A 220']?->id, 'name' => '2.0L Turbo', 'code' => 'M260 DE20', 'displacement' => 2.0, 'horsepower' => 190, 'kw' => 140, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['A 250']?->id, 'name' => '2.0L Turbo', 'code' => 'M260 DE20', 'displacement' => 2.0, 'horsepower' => 224, 'kw' => 165, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2018],
            ['car_model_id' => $models['C 200']?->id, 'name' => '1.5L Turbo + EQ Boost', 'code' => 'M264 DE15', 'displacement' => 1.5, 'horsepower' => 184, 'kw' => 135, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2018],
            ['car_model_id' => $models['C 300']?->id, 'name' => '2.0L Turbo', 'code' => 'M264 DE20', 'displacement' => 2.0, 'horsepower' => 258, 'kw' => 190, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2018],
            ['car_model_id' => $models['E 200']?->id, 'name' => '2.0L Turbo', 'code' => 'M264 DE20', 'displacement' => 2.0, 'horsepower' => 197, 'kw' => 145, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['E 300']?->id, 'name' => '2.0L Turbo', 'code' => 'M264 DE20', 'displacement' => 2.0, 'horsepower' => 258, 'kw' => 190, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['GLC 300']?->id, 'name' => '2.0L Turbo', 'code' => 'M264 DE20', 'displacement' => 2.0, 'horsepower' => 258, 'kw' => 190, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2022],

            // ==================== M133 (AMG 4-цилиндровые) ====================
            ['car_model_id' => $models['A 45 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M133 DE20', 'displacement' => 2.0, 'horsepower' => 360, 'kw' => 265, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013, 'year_to' => 2018],
            ['car_model_id' => $models['A 45 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M133 DE20', 'displacement' => 2.0, 'horsepower' => 381, 'kw' => 280, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => 2018],
            ['car_model_id' => $models['CLA 45 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M133 DE20', 'displacement' => 2.0, 'horsepower' => 360, 'kw' => 265, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013, 'year_to' => 2018],
            ['car_model_id' => $models['GLA 45 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M133 DE20', 'displacement' => 2.0, 'horsepower' => 360, 'kw' => 265, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013, 'year_to' => 2018],

            // ==================== M139 (новые AMG 4-цилиндровые) ====================
            ['car_model_id' => $models['A 35 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M260 DE20', 'displacement' => 2.0, 'horsepower' => 306, 'kw' => 225, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['A 45 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M139 DE20', 'displacement' => 2.0, 'horsepower' => 382, 'kw' => 281, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['A 45 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M139 DE20', 'displacement' => 2.0, 'horsepower' => 416, 'kw' => 306, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['CLA 35 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M260 DE20', 'displacement' => 2.0, 'horsepower' => 306, 'kw' => 225, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['CLA 45 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M139 DE20', 'displacement' => 2.0, 'horsepower' => 382, 'kw' => 281, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['GLA 35 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M260 DE20', 'displacement' => 2.0, 'horsepower' => 306, 'kw' => 225, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['GLA 45 AMG']?->id, 'name' => '2.0L Turbo', 'code' => 'M139 DE20', 'displacement' => 2.0, 'horsepower' => 382, 'kw' => 281, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2020],

            // ==================== M276/M278 (V6 бензиновые) ====================
            ['car_model_id' => $models['C 350']?->id, 'name' => '3.5L V6', 'code' => 'M276 DE35', 'displacement' => 3.5, 'horsepower' => 306, 'kw' => 225, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2011, 'year_to' => 2015],
            ['car_model_id' => $models['E 350']?->id, 'name' => '3.5L V6', 'code' => 'M276 DE35', 'displacement' => 3.5, 'horsepower' => 306, 'kw' => 225, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2011, 'year_to' => 2016],
            ['car_model_id' => $models['E 400']?->id, 'name' => '3.0L V6 Twin-Turbo', 'code' => 'M276 DE30', 'displacement' => 3.0, 'horsepower' => 333, 'kw' => 245, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2013, 'year_to' => 2016],
            ['car_model_id' => $models['E 450']?->id, 'name' => '3.0L V6 Twin-Turbo', 'code' => 'M276 DE30', 'displacement' => 3.0, 'horsepower' => 367, 'kw' => 270, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2016, 'year_to' => 2020],
            ['car_model_id' => $models['S 400']?->id, 'name' => '3.0L V6 Twin-Turbo', 'code' => 'M276 DE30', 'displacement' => 3.0, 'horsepower' => 333, 'kw' => 245, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2013, 'year_to' => 2017],
            ['car_model_id' => $models['S 450']?->id, 'name' => '3.0L V6 Twin-Turbo', 'code' => 'M276 DE30', 'displacement' => 3.0, 'horsepower' => 367, 'kw' => 270, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2017, 'year_to' => 2020],
            ['car_model_id' => $models['GLE 400']?->id, 'name' => '3.0L V6 Twin-Turbo', 'code' => 'M276 DE30', 'displacement' => 3.0, 'horsepower' => 333, 'kw' => 245, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2015, 'year_to' => 2019],
            ['car_model_id' => $models['GLE 450']?->id, 'name' => '3.0L V6 Twin-Turbo', 'code' => 'M276 DE30', 'displacement' => 3.0, 'horsepower' => 367, 'kw' => 270, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2019],

            // ==================== M256 (рядная 6-цилиндровая с EQ Boost) ====================
            ['car_model_id' => $models['E 450']?->id, 'name' => '3.0L Turbo + EQ Boost', 'code' => 'M256 DE30', 'displacement' => 3.0, 'horsepower' => 367, 'kw' => 270, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['E 53 AMG']?->id, 'name' => '3.0L Turbo + EQ Boost', 'code' => 'M256 DE30', 'displacement' => 3.0, 'horsepower' => 435, 'kw' => 320, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2018],
            ['car_model_id' => $models['S 500']?->id, 'name' => '3.0L Turbo + EQ Boost', 'code' => 'M256 DE30', 'displacement' => 3.0, 'horsepower' => 435, 'kw' => 320, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['GLE 450']?->id, 'name' => '3.0L Turbo + EQ Boost', 'code' => 'M256 DE30', 'displacement' => 3.0, 'horsepower' => 367, 'kw' => 270, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['GLE 53 AMG']?->id, 'name' => '3.0L Turbo + EQ Boost', 'code' => 'M256 DE30', 'displacement' => 3.0, 'horsepower' => 435, 'kw' => 320, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['CLS 53 AMG']?->id, 'name' => '3.0L Turbo + EQ Boost', 'code' => 'M256 DE30', 'displacement' => 3.0, 'horsepower' => 435, 'kw' => 320, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2018],

            // ==================== M157/M177/M178 (V8 AMG) ====================
            ['car_model_id' => $models['C 63 AMG']?->id, 'name' => '4.0L V8 Twin-Turbo', 'code' => 'M177 DE40', 'displacement' => 4.0, 'horsepower' => 476, 'kw' => 350, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Твин-турбо', 'year_from' => 2015, 'year_to' => 2021],
            ['car_model_id' => $models['C 63 AMG']?->id, 'name' => '4.0L V8 Twin-Turbo', 'code' => 'M177 DE40', 'displacement' => 4.0, 'horsepower' => 510, 'kw' => 375, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Твин-турбо', 'year_from' => 2015, 'year_to' => 2021],
            ['car_model_id' => $models['E 63 AMG']?->id, 'name' => '4.0L V8 Twin-Turbo', 'code' => 'M177 DE40', 'displacement' => 4.0, 'horsepower' => 571, 'kw' => 420, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Твин-турбо', 'year_from' => 2016],
            ['car_model_id' => $models['E 63 AMG']?->id, 'name' => '4.0L V8 Twin-Turbo', 'code' => 'M177 DE40', 'displacement' => 4.0, 'horsepower' => 612, 'kw' => 450, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Твин-турбо', 'year_from' => 2018],
            ['car_model_id' => $models['S 63 AMG']?->id, 'name' => '4.0L V8 Twin-Turbo', 'code' => 'M177 DE40', 'displacement' => 4.0, 'horsepower' => 612, 'kw' => 450, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Твин-турбо', 'year_from' => 2017],
            ['car_model_id' => $models['G 63 AMG']?->id, 'name' => '4.0L V8 Twin-Turbo', 'code' => 'M177 DE40', 'displacement' => 4.0, 'horsepower' => 585, 'kw' => 430, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Твин-турбо', 'year_from' => 2018],
            ['car_model_id' => $models['AMG GT 63']?->id, 'name' => '4.0L V8 Twin-Turbo', 'code' => 'M177 DE40', 'displacement' => 4.0, 'horsepower' => 577, 'kw' => 425, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Твин-турбо', 'year_from' => 2018],
            ['car_model_id' => $models['AMG GT R']?->id, 'name' => '4.0L V8 Twin-Turbo', 'code' => 'M177 DE40', 'displacement' => 4.0, 'horsepower' => 585, 'kw' => 430, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Твин-турбо', 'year_from' => 2016],

            // ==================== M275/M279 (V12) ====================
            ['car_model_id' => $models['S 65 AMG']?->id, 'name' => '6.0L V12 Twin-Turbo', 'code' => 'M279 DE60', 'displacement' => 6.0, 'horsepower' => 630, 'kw' => 463, 'fuel_type' => 'Бензин', 'cylinders' => 12, 'turbo' => 'Твин-турбо', 'year_from' => 2013, 'year_to' => 2019],

            // ==================== Дизельные двигатели ====================
            ['car_model_id' => $models['C 220']?->id, 'name' => '2.1L Diesel', 'code' => 'OM651 DE22', 'displacement' => 2.1, 'horsepower' => 170, 'kw' => 125, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2008, 'year_to' => 2018],
            ['car_model_id' => $models['C 250']?->id, 'name' => '2.1L Diesel', 'code' => 'OM651 DE22', 'displacement' => 2.1, 'horsepower' => 204, 'kw' => 150, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2018],
            ['car_model_id' => $models['E 220']?->id, 'name' => '2.0L Diesel', 'code' => 'OM654 DE20', 'displacement' => 2.0, 'horsepower' => 194, 'kw' => 143, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2016],
            ['car_model_id' => $models['E 300']?->id, 'name' => '2.0L Diesel', 'code' => 'OM654 DE20', 'displacement' => 2.0, 'horsepower' => 240, 'kw' => 177, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2018],
            ['car_model_id' => $models['S 350']?->id, 'name' => '3.0L V6 Diesel', 'code' => 'OM642 DE30', 'displacement' => 3.0, 'horsepower' => 258, 'kw' => 190, 'fuel_type' => 'Дизель', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2020],
            ['car_model_id' => $models['GLE 350']?->id, 'name' => '3.0L V6 Diesel', 'code' => 'OM642 DE30', 'displacement' => 3.0, 'horsepower' => 258, 'kw' => 190, 'fuel_type' => 'Дизель', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => 2019],
            ['car_model_id' => $models['GLS 400']?->id, 'name' => '3.0L V6 Diesel', 'code' => 'OM642 DE30', 'displacement' => 3.0, 'horsepower' => 330, 'kw' => 243, 'fuel_type' => 'Дизель', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['ML 250']?->id, 'name' => '2.1L Diesel', 'code' => 'OM651 DE22', 'displacement' => 2.1, 'horsepower' => 204, 'kw' => 150, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2011, 'year_to' => 2015],
            ['car_model_id' => $models['ML 350']?->id, 'name' => '3.0L V6 Diesel', 'code' => 'OM642 DE30', 'displacement' => 3.0, 'horsepower' => 258, 'kw' => 190, 'fuel_type' => 'Дизель', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2009, 'year_to' => 2015],
            ['car_model_id' => $models['GLK 220']?->id, 'name' => '2.1L Diesel', 'code' => 'OM651 DE22', 'displacement' => 2.1, 'horsepower' => 170, 'kw' => 125, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2008, 'year_to' => 2015],
            ['car_model_id' => $models['GLK 250']?->id, 'name' => '2.1L Diesel', 'code' => 'OM651 DE22', 'displacement' => 2.1, 'horsepower' => 204, 'kw' => 150, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2015],

            // ==================== Электромоторы (EQ) ====================
            ['car_model_id' => $models['EQA 250']?->id, 'name' => 'Electric', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 190, 'kw' => 140, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['EQB 250']?->id, 'name' => 'Electric', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 190, 'kw' => 140, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['EQB 300']?->id, 'name' => 'Electric AWD', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 228, 'kw' => 170, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['EQB 350']?->id, 'name' => 'Electric AWD', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 292, 'kw' => 215, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['EQC 400']?->id, 'name' => 'Electric AWD', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 402, 'kw' => 300, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2019],
            ['car_model_id' => $models['EQE 300']?->id, 'name' => 'Electric', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 245, 'kw' => 180, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2022],
            ['car_model_id' => $models['EQE 350']?->id, 'name' => 'Electric', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 292, 'kw' => 215, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2022],
            ['car_model_id' => $models['EQE 500']?->id, 'name' => 'Electric AWD', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 402, 'kw' => 300, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2022],
            ['car_model_id' => $models['EQE 53 AMG']?->id, 'name' => 'Electric AWD', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 617, 'kw' => 460, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2022],
            ['car_model_id' => $models['EQS 450']?->id, 'name' => 'Electric', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 355, 'kw' => 265, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['EQS 580']?->id, 'name' => 'Electric AWD', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 516, 'kw' => 385, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['EQS 680 Maybach']?->id, 'name' => 'Electric AWD', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 649, 'kw' => 484, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2023],
            ['car_model_id' => $models['EQV 300']?->id, 'name' => 'Electric', 'code' => 'EM', 'displacement' => 0.0, 'horsepower' => 204, 'kw' => 150, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2020],
        ];

        foreach ($engines as $engine) {
            if ($engine['car_model_id']) {
                Engine::updateOrCreate(
                    ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                    $engine
                );
            }
        }

        $this->command->info('✓ Mercedes-Benz engines seeded: ' . count($engines));
    }
}
