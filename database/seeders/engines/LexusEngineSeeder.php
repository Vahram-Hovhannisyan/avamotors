<?php

namespace Database\Seeders\Engines;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Engine;

class LexusEngineSeeder extends Seeder
{
    public function run(): void
    {
        $lexus = CarMake::where('name', 'Lexus')->first();

        if (!$lexus) {
            $this->command->error('Lexus not found!');
            return;
        }

        $models = [
            'IS 200' => CarModel::where('car_make_id', $lexus->id)->where('name', 'IS 200')->first(),
            'IS 250' => CarModel::where('car_make_id', $lexus->id)->where('name', 'IS 250')->first(),
            'IS 300' => CarModel::where('car_make_id', $lexus->id)->where('name', 'IS 300')->first(),
            'IS 350' => CarModel::where('car_make_id', $lexus->id)->where('name', 'IS 350')->first(),
            'IS 500' => CarModel::where('car_make_id', $lexus->id)->where('name', 'IS 500')->first(),
            'ES 250' => CarModel::where('car_make_id', $lexus->id)->where('name', 'ES 250')->first(),
            'ES 300' => CarModel::where('car_make_id', $lexus->id)->where('name', 'ES 300')->first(),
            'ES 350' => CarModel::where('car_make_id', $lexus->id)->where('name', 'ES 350')->first(),
            'ES 300h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'ES 300h')->first(),
            'RX 300' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RX 300')->first(),
            'RX 330' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RX 330')->first(),
            'RX 350' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RX 350')->first(),
            'RX 350h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RX 350h')->first(),
            'RX 450h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RX 450h')->first(),
            'RX 500h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RX 500h')->first(),
            'NX 200t' => CarModel::where('car_make_id', $lexus->id)->where('name', 'NX 200t')->first(),
            'NX 300' => CarModel::where('car_make_id', $lexus->id)->where('name', 'NX 300')->first(),
            'NX 300h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'NX 300h')->first(),
            'NX 350' => CarModel::where('car_make_id', $lexus->id)->where('name', 'NX 350')->first(),
            'NX 350h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'NX 350h')->first(),
            'NX 450h+' => CarModel::where('car_make_id', $lexus->id)->where('name', 'NX 450h+')->first(),
            'UX 200' => CarModel::where('car_make_id', $lexus->id)->where('name', 'UX 200')->first(),
            'UX 250h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'UX 250h')->first(),
            'UX 300e' => CarModel::where('car_make_id', $lexus->id)->where('name', 'UX 300e')->first(),
            'GX 460' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GX 460')->first(),
            'GX 470' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GX 470')->first(),
            'GX 550' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GX 550')->first(),
            'LX 470' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LX 470')->first(),
            'LX 570' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LX 570')->first(),
            'LX 600' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LX 600')->first(),
            'LX 700h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LX 700h')->first(),
            'LS 400' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LS 400')->first(),
            'LS 430' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LS 430')->first(),
            'LS 460' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LS 460')->first(),
            'LS 500' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LS 500')->first(),
            'LS 500h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LS 500h')->first(),
            'LS 600h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LS 600h')->first(),
            'GS 300' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GS 300')->first(),
            'GS 350' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GS 350')->first(),
            'GS 400' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GS 400')->first(),
            'GS 430' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GS 430')->first(),
            'GS 450h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GS 450h')->first(),
            'GS F' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GS F')->first(),
            'RC 200t' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RC 200t')->first(),
            'RC 300' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RC 300')->first(),
            'RC 350' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RC 350')->first(),
            'RC F' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RC F')->first(),
            'LC 500' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LC 500')->first(),
            'LC 500h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LC 500h')->first(),
            'LFA' => CarModel::where('car_make_id', $lexus->id)->where('name', 'LFA')->first(),
            'RZ 450e' => CarModel::where('car_make_id', $lexus->id)->where('name', 'RZ 450e')->first(),
            'TX 350' => CarModel::where('car_make_id', $lexus->id)->where('name', 'TX 350')->first(),
            'TX 500h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'TX 500h')->first(),
            'TX 550h+' => CarModel::where('car_make_id', $lexus->id)->where('name', 'TX 550h+')->first(),
            'HS 250h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'HS 250h')->first(), // Добавлено
            'IS 200t' => CarModel::where('car_make_id', $lexus->id)->where('name', 'IS 200t')->first(), // Добавлено
            'GS 200t' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GS 200t')->first(), // Добавлено
            'CT 200h' => CarModel::where('car_make_id', $lexus->id)->where('name', 'CT 200h')->first(), // Добавлено
            'NX 250' => CarModel::where('car_make_id', $lexus->id)->where('name', 'NX 250')->first(), // Добавлено
            'GS 460' => CarModel::where('car_make_id', $lexus->id)->where('name', 'GS 460')->first(), // Добавлено
        ];

        $engines = [
            // ==================== Рядные 4-цилиндровые (Toyota-based) ====================

            // Серия 1AZ-FE (2.0L) - старые модели
            ['car_model_id' => $models['IS 200']?->id, 'name' => '2.0L', 'code' => '1AZ-FE', 'displacement' => 2.0, 'horsepower' => 153, 'kw' => 114, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2005],
            ['car_model_id' => $models['IS 200']?->id, 'name' => '2.0L', 'code' => '1G-FE', 'displacement' => 2.0, 'horsepower' => 155, 'kw' => 116, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 1998, 'year_to' => 2005],

            // Серия 2AZ-FE (2.4L) - гибрид
            ['car_model_id' => $models['HS 250h']?->id, 'name' => '2.4L Hybrid', 'code' => '2AZ-FXE', 'displacement' => 2.4, 'horsepower' => 187, 'kw' => 139, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2012],

            // Серия 8AR-FTS (2.0L Turbo)
            ['car_model_id' => $models['NX 200t']?->id, 'name' => '2.0L Turbo', 'code' => '8AR-FTS', 'displacement' => 2.0, 'horsepower' => 235, 'kw' => 175, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2014, 'year_to' => 2017],
            ['car_model_id' => $models['IS 200t']?->id, 'name' => '2.0L Turbo', 'code' => '8AR-FTS', 'displacement' => 2.0, 'horsepower' => 241, 'kw' => 180, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => 2020],
            ['car_model_id' => $models['RC 200t']?->id, 'name' => '2.0L Turbo', 'code' => '8AR-FTS', 'displacement' => 2.0, 'horsepower' => 241, 'kw' => 180, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => 2018],
            ['car_model_id' => $models['GS 200t']?->id, 'name' => '2.0L Turbo', 'code' => '8AR-FTS', 'displacement' => 2.0, 'horsepower' => 241, 'kw' => 180, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2016, 'year_to' => 2018],

            // Серия A25A (2.5L Dynamic Force)
            ['car_model_id' => $models['ES 250']?->id, 'name' => '2.5L', 'code' => 'A25A-FKS', 'displacement' => 2.5, 'horsepower' => 203, 'kw' => 151, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018],
            ['car_model_id' => $models['NX 250']?->id, 'name' => '2.5L', 'code' => 'A25A-FKS', 'displacement' => 2.5, 'horsepower' => 203, 'kw' => 151, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['UX 200']?->id, 'name' => '2.0L', 'code' => 'M20A-FKS', 'displacement' => 2.0, 'horsepower' => 168, 'kw' => 125, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018],
            ['car_model_id' => $models['IS 300']?->id, 'name' => '2.0L Turbo', 'code' => '8AR-FTS', 'displacement' => 2.0, 'horsepower' => 241, 'kw' => 180, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2016, 'year_to' => 2020],

            // ==================== Гибридные 4-цилиндровые ====================
            ['car_model_id' => $models['ES 300h']?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 215, 'kw' => 160, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018],
            ['car_model_id' => $models['NX 350h']?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 239, 'kw' => 178, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['RX 350h']?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 246, 'kw' => 183, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2022],
            ['car_model_id' => $models['UX 250h']?->id, 'name' => '2.0L Hybrid', 'code' => 'M20A-FXS', 'displacement' => 2.0, 'horsepower' => 181, 'kw' => 135, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018],
            ['car_model_id' => $models['CT 200h']?->id, 'name' => '1.8L Hybrid', 'code' => '2ZR-FXE', 'displacement' => 1.8, 'horsepower' => 134, 'kw' => 100, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => 2020],

            // ==================== V6 двигатели (GR Series) ====================

            // 2GR-FE (3.5L) - атмосферный
            ['car_model_id' => $models['ES 350']?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 268, 'kw' => 200, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2018],
            ['car_model_id' => $models['RX 350']?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 270, 'kw' => 201, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2015],
            ['car_model_id' => $models['IS 350']?->id, 'name' => '3.5L V6', 'code' => '2GR-FSE', 'displacement' => 3.5, 'horsepower' => 306, 'kw' => 228, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2014],
            ['car_model_id' => $models['GS 350']?->id, 'name' => '3.5L V6', 'code' => '2GR-FSE', 'displacement' => 3.5, 'horsepower' => 303, 'kw' => 226, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2011],

            // 2GR-FKS (3.5L) - новый
            ['car_model_id' => $models['ES 350']?->id, 'name' => '3.5L V6', 'code' => '2GR-FKS', 'displacement' => 3.5, 'horsepower' => 302, 'kw' => 225, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2018],
            ['car_model_id' => $models['RX 350']?->id, 'name' => '3.5L V6', 'code' => '2GR-FKS', 'displacement' => 3.5, 'horsepower' => 295, 'kw' => 220, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2015],
            ['car_model_id' => $models['IS 350']?->id, 'name' => '3.5L V6', 'code' => '2GR-FKS', 'displacement' => 3.5, 'horsepower' => 311, 'kw' => 232, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2014],
            ['car_model_id' => $models['RC 350']?->id, 'name' => '3.5L V6', 'code' => '2GR-FKS', 'displacement' => 3.5, 'horsepower' => 311, 'kw' => 232, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2014],
            ['car_model_id' => $models['GS 350']?->id, 'name' => '3.5L V6', 'code' => '2GR-FKS', 'displacement' => 3.5, 'horsepower' => 311, 'kw' => 232, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2012, 'year_to' => 2020],

            // 2GR-FXE (3.5L Hybrid)
            ['car_model_id' => $models['RX 450h']?->id, 'name' => '3.5L V6 Hybrid', 'code' => '2GR-FXE', 'displacement' => 3.5, 'horsepower' => 295, 'kw' => 220, 'fuel_type' => 'Гибрид', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2015],
            ['car_model_id' => $models['GS 450h']?->id, 'name' => '3.5L V6 Hybrid', 'code' => '2GR-FSE', 'displacement' => 3.5, 'horsepower' => 338, 'kw' => 252, 'fuel_type' => 'Гибрид', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2011],
            ['car_model_id' => $models['LS 600h']?->id, 'name' => '5.0L V8 Hybrid', 'code' => '2UR-FSE', 'displacement' => 5.0, 'horsepower' => 438, 'kw' => 327, 'fuel_type' => 'Гибрид', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2017],

            // ==================== V8 двигатели (UR Series) ====================

            // 1UR-FE (4.6L)
            ['car_model_id' => $models['GS 460']?->id, 'name' => '4.6L V8', 'code' => '1UR-FE', 'displacement' => 4.6, 'horsepower' => 342, 'kw' => 255, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2011],
            ['car_model_id' => $models['LS 460']?->id, 'name' => '4.6L V8', 'code' => '1UR-FE', 'displacement' => 4.6, 'horsepower' => 380, 'kw' => 283, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2017],
            ['car_model_id' => $models['GX 460']?->id, 'name' => '4.6L V8', 'code' => '1UR-FE', 'displacement' => 4.6, 'horsepower' => 301, 'kw' => 224, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2023],

            // 3UR-FE (5.7L)
            ['car_model_id' => $models['LX 570']?->id, 'name' => '5.7L V8', 'code' => '3UR-FE', 'displacement' => 5.7, 'horsepower' => 383, 'kw' => 286, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2021],

            // 2UR-GSE (5.0L V8) - F Sport
            ['car_model_id' => $models['IS 500']?->id, 'name' => '5.0L V8', 'code' => '2UR-GSE', 'displacement' => 5.0, 'horsepower' => 472, 'kw' => 352, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['RC F']?->id, 'name' => '5.0L V8', 'code' => '2UR-GSE', 'displacement' => 5.0, 'horsepower' => 467, 'kw' => 348, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2014],
            ['car_model_id' => $models['GS F']?->id, 'name' => '5.0L V8', 'code' => '2UR-GSE', 'displacement' => 5.0, 'horsepower' => 467, 'kw' => 348, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2015, 'year_to' => 2020],
            ['car_model_id' => $models['LC 500']?->id, 'name' => '5.0L V8', 'code' => '2UR-GSE', 'displacement' => 5.0, 'horsepower' => 471, 'kw' => 351, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2017],

            // ==================== V6 Turbo (V35A-FTS) ====================
            ['car_model_id' => $models['LS 500']?->id, 'name' => '3.5L V6 Twin-Turbo', 'code' => 'V35A-FTS', 'displacement' => 3.5, 'horsepower' => 416, 'kw' => 310, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2017],
            ['car_model_id' => $models['LX 600']?->id, 'name' => '3.5L V6 Twin-Turbo', 'code' => 'V35A-FTS', 'displacement' => 3.5, 'horsepower' => 409, 'kw' => 305, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2021],
            ['car_model_id' => $models['GX 550']?->id, 'name' => '3.5L V6 Twin-Turbo', 'code' => 'V35A-FTS', 'displacement' => 3.5, 'horsepower' => 349, 'kw' => 260, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2023],

            // ==================== Гибридные V6 (новые) ====================
            ['car_model_id' => $models['RX 500h']?->id, 'name' => '2.4L Turbo Hybrid', 'code' => 'T24A-FTS', 'displacement' => 2.4, 'horsepower' => 366, 'kw' => 273, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2022],
            ['car_model_id' => $models['TX 550h+']?->id, 'name' => '3.5L V6 Plug-in Hybrid', 'code' => 'V35A-FXS', 'displacement' => 3.5, 'horsepower' => 404, 'kw' => 301, 'fuel_type' => 'Гибрид', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2023],
            ['car_model_id' => $models['TX 500h']?->id, 'name' => '2.4L Turbo Hybrid', 'code' => 'T24A-FTS', 'displacement' => 2.4, 'horsepower' => 366, 'kw' => 273, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2023],
            ['car_model_id' => $models['LX 700h']?->id, 'name' => '3.5L V6 Twin-Turbo Hybrid', 'code' => 'V35A-FTS', 'displacement' => 3.5, 'horsepower' => 457, 'kw' => 341, 'fuel_type' => 'Гибрид', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2024],

            // ==================== Электромоторы ====================
            ['car_model_id' => $models['UX 300e']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 201, 'kw' => 150, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2020],
            ['car_model_id' => $models['RZ 450e']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 308, 'kw' => 230, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2022],

            // ==================== Рядные 6-цилиндровые (старые) ====================
            ['car_model_id' => $models['IS 300']?->id, 'name' => '3.0L', 'code' => '2JZ-GE', 'displacement' => 3.0, 'horsepower' => 215, 'kw' => 160, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2005],
            ['car_model_id' => $models['GS 300']?->id, 'name' => '3.0L', 'code' => '2JZ-GE', 'displacement' => 3.0, 'horsepower' => 220, 'kw' => 164, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 1998, 'year_to' => 2005],
            ['car_model_id' => $models['GS 400']?->id, 'name' => '4.0L V8', 'code' => '1UZ-FE', 'displacement' => 4.0, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 1998, 'year_to' => 2000],
            ['car_model_id' => $models['GS 430']?->id, 'name' => '4.3L V8', 'code' => '3UZ-FE', 'displacement' => 4.3, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2001, 'year_to' => 2007],
            ['car_model_id' => $models['LS 400']?->id, 'name' => '4.0L V8', 'code' => '1UZ-FE', 'displacement' => 4.0, 'horsepower' => 250, 'kw' => 186, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 1989, 'year_to' => 2000],
            ['car_model_id' => $models['LS 430']?->id, 'name' => '4.3L V8', 'code' => '3UZ-FE', 'displacement' => 4.3, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2006],

            // ==================== LFA V10 ====================
            ['car_model_id' => $models['LFA']?->id, 'name' => '4.8L V10', 'code' => '1LR-GUE', 'displacement' => 4.8, 'horsepower' => 552, 'kw' => 412, 'fuel_type' => 'Бензин', 'cylinders' => 10, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => 2012],

            // ==================== GX 470 V8 ====================
            ['car_model_id' => $models['GX 470']?->id, 'name' => '4.7L V8', 'code' => '2UZ-FE', 'displacement' => 4.7, 'horsepower' => 263, 'kw' => 196, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2002, 'year_to' => 2009],

            // ==================== LX 470 V8 ====================
            ['car_model_id' => $models['LX 470']?->id, 'name' => '4.7L V8', 'code' => '2UZ-FE', 'displacement' => 4.7, 'horsepower' => 275, 'kw' => 205, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 1998, 'year_to' => 2007],

            // ==================== LC 500h V6 Hybrid ====================
            ['car_model_id' => $models['LC 500h']?->id, 'name' => '3.5L V6 Hybrid', 'code' => '8GR-FXS', 'displacement' => 3.5, 'horsepower' => 354, 'kw' => 264, 'fuel_type' => 'Гибрид', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2017],
        ];

        foreach ($engines as $engine) {
            if ($engine['car_model_id']) {
                Engine::updateOrCreate(
                    ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                    $engine
                );
            }
        }

        $this->command->info('✓ Lexus engines seeded: ' . count($engines));
    }
}
