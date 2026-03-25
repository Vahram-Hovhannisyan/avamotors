<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Engine;

class EngineSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем ID производителей
        $toyota = CarMake::where('name', 'LIKE', '%Toyota%')->first();
        $lexus = CarMake::where('name', 'LIKE', '%Lexus%')->first();
        $kia = CarMake::where('name', 'LIKE', '%Kia%')->first();
        $hyundai = CarMake::where('name', 'LIKE', '%Hyundai%')->first();
        $nissan = CarMake::where('name', 'LIKE', '%Nissan%')->first();

        // ==================== TOYOTA ====================
        if ($toyota) {
            $camry = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Camry%')->first();
            $corolla = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Corolla%')->first();
            $rav4 = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%RAV4%')->first();
            $landCruiser = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Land Cruiser%')->first();
            $prius = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Prius%')->first();
            $highlander = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Highlander%')->first();
            $yaris = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Yaris%')->first();
            $auris = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Auris%')->first();
            $avensis = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Avensis%')->first();
            $alphard = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Alphard%')->first();
            $estima = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Estima%')->first();
            $previa = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Previa%')->first();
            $matrix = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Matrix%')->first();
            $scion = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Scion%')->first();
            $solara = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Solara%')->first();
            $wish = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Wish%')->first();
            $celica = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Celica%')->first();
            $mr2 = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%MR2%')->first();
            $premio = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Premio%')->first();
            $allion = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Allion%')->first();
            $vista = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Vista%')->first();
            $aygo = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Aygo%')->first();
            $vitz = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Vitz%')->first();
            $altezza = CarModel::where('car_make_id', $toyota->id)->where('name', 'LIKE', '%Altezza%')->first();

            $engines = [
                // Camry
                ['car_model_id' => $camry?->id, 'name' => '2.5L Dynamic Force', 'code' => 'A25A-FKS', 'displacement' => 2.5, 'horsepower' => 203, 'kw' => 151, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2017, 'year_to' => null],
                ['car_model_id' => $camry?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 268, 'kw' => 200, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2017],
                ['car_model_id' => $camry?->id, 'name' => '2.0L', 'code' => '1AZ-FE', 'displacement' => 2.0, 'horsepower' => 147, 'kw' => 110, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2012],
                ['car_model_id' => $camry?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 158, 'kw' => 118, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2002, 'year_to' => 2011],

                // Corolla
                ['car_model_id' => $corolla?->id, 'name' => '1.8L', 'code' => '2ZR-FE', 'displacement' => 1.8, 'horsepower' => 132, 'kw' => 98, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => null],
                ['car_model_id' => $corolla?->id, 'name' => '1.6L', 'code' => '1ZR-FE', 'displacement' => 1.6, 'horsepower' => 122, 'kw' => 91, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => null],
                ['car_model_id' => $corolla?->id, 'name' => '1.8L', 'code' => '1ZZ-FE', 'displacement' => 1.8, 'horsepower' => 132, 'kw' => 98, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2008],
                ['car_model_id' => $corolla?->id, 'name' => '1.6L', 'code' => '3ZZ-FE', 'displacement' => 1.6, 'horsepower' => 110, 'kw' => 82, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2008],
                ['car_model_id' => $corolla?->id, 'name' => '2.0L Hybrid', 'code' => '2ZR-FXE', 'displacement' => 1.8, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018, 'year_to' => null],
                ['car_model_id' => $corolla?->id, 'name' => '1.4L D-4D', 'code' => '1ND-TV', 'displacement' => 1.4, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2004, 'year_to' => 2013],

                // RAV4
                ['car_model_id' => $rav4?->id, 'name' => '2.0L', 'code' => '3ZR-FE', 'displacement' => 2.0, 'horsepower' => 146, 'kw' => 109, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2015],
                ['car_model_id' => $rav4?->id, 'name' => '2.0L', 'code' => '1AZ-FE', 'displacement' => 2.0, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2005],
                ['car_model_id' => $rav4?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 166, 'kw' => 124, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2012],
                ['car_model_id' => $rav4?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 219, 'kw' => 163, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018, 'year_to' => null],
                ['car_model_id' => $rav4?->id, 'name' => '2.2L D-4D', 'code' => '2AD-FTV', 'displacement' => 2.2, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2005, 'year_to' => 2012],

                // Land Cruiser
                ['car_model_id' => $landCruiser?->id, 'name' => '4.5L V8 Diesel', 'code' => '1VD-FTV', 'displacement' => 4.5, 'horsepower' => 202, 'kw' => 151, 'fuel_type' => 'Дизель', 'cylinders' => 8, 'turbo' => 'Турбо', 'year_from' => 2007, 'year_to' => null],
                ['car_model_id' => $landCruiser?->id, 'name' => '4.6L V8', 'code' => '1UR-FE', 'displacement' => 4.6, 'horsepower' => 309, 'kw' => 230, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => null],
                ['car_model_id' => $landCruiser?->id, 'name' => '3.0L D-4D', 'code' => '1KD-FTV', 'displacement' => 3.0, 'horsepower' => 163, 'kw' => 122, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2001, 'year_to' => 2009],

                // Prius
                ['car_model_id' => $prius?->id, 'name' => '1.8L Hybrid', 'code' => '2ZR-FXE', 'displacement' => 1.8, 'horsepower' => 98, 'kw' => 73, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => null],

                // Highlander
                ['car_model_id' => $highlander?->id, 'name' => '3.5L V6', 'code' => '2GR-FKS', 'displacement' => 3.5, 'horsepower' => 295, 'kw' => 220, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2016, 'year_to' => null],
                ['car_model_id' => $highlander?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 160, 'kw' => 119, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2001, 'year_to' => 2007],
                ['car_model_id' => $highlander?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 243, 'kw' => 181, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2020, 'year_to' => null],

                // Yaris / Vitz
                ['car_model_id' => $yaris?->id, 'name' => '1.0L', 'code' => '1KR-FE', 'displacement' => 1.0, 'horsepower' => 68, 'kw' => 51, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => null],
                ['car_model_id' => $yaris?->id, 'name' => '1.3L', 'code' => '2NZ-FE', 'displacement' => 1.3, 'horsepower' => 87, 'kw' => 65, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2005],
                ['car_model_id' => $yaris?->id, 'name' => '1.5L', 'code' => '1NZ-FE', 'displacement' => 1.5, 'horsepower' => 105, 'kw' => 78, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2005],

                // Auris
                ['car_model_id' => $auris?->id, 'name' => '1.6L', 'code' => '1ZR-FE', 'displacement' => 1.6, 'horsepower' => 122, 'kw' => 91, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2018],
                ['car_model_id' => $auris?->id, 'name' => '1.8L', 'code' => '2ZR-FE', 'displacement' => 1.8, 'horsepower' => 136, 'kw' => 101, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2018],

                // Avensis
                ['car_model_id' => $avensis?->id, 'name' => '1.6L', 'code' => '1ZZ-FE', 'displacement' => 1.6, 'horsepower' => 110, 'kw' => 82, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2008],
                ['car_model_id' => $avensis?->id, 'name' => '1.8L', 'code' => '1ZZ-FE', 'displacement' => 1.8, 'horsepower' => 129, 'kw' => 96, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2008],
                ['car_model_id' => $avensis?->id, 'name' => '2.0L', 'code' => '1AZ-FE', 'displacement' => 2.0, 'horsepower' => 147, 'kw' => 110, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2008],
                ['car_model_id' => $avensis?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 163, 'kw' => 122, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2008],

                // Alphard
                ['car_model_id' => $alphard?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 160, 'kw' => 119, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2002, 'year_to' => 2005],

                // Estima / Previa
                ['car_model_id' => $estima?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 160, 'kw' => 119, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2005],

                // Matrix
                ['car_model_id' => $matrix?->id, 'name' => '1.8L', 'code' => '1ZZ-FE', 'displacement' => 1.8, 'horsepower' => 130, 'kw' => 97, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2008],
                ['car_model_id' => $matrix?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 158, 'kw' => 118, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2008],

                // Wish
                ['car_model_id' => $wish?->id, 'name' => '1.8L', 'code' => '1ZZ-FE', 'displacement' => 1.8, 'horsepower' => 132, 'kw' => 98, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2009],
                ['car_model_id' => $wish?->id, 'name' => '2.0L', 'code' => '1AZ-FE', 'displacement' => 2.0, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2009],

                // Celica
                ['car_model_id' => $celica?->id, 'name' => '1.8L', 'code' => '1ZZ-FE', 'displacement' => 1.8, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2006],
                ['car_model_id' => $celica?->id, 'name' => '1.8L', 'code' => '2ZZ-GE', 'displacement' => 1.8, 'horsepower' => 190, 'kw' => 142, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2006],

                // MR2
                ['car_model_id' => $mr2?->id, 'name' => '1.8L', 'code' => '1ZZ-FE', 'displacement' => 1.8, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2007],

                // Altezza
                ['car_model_id' => $altezza?->id, 'name' => '2.0L', 'code' => '3S-GE', 'displacement' => 2.0, 'horsepower' => 210, 'kw' => 157, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2001, 'year_to' => 2005],

                // Aygo
                ['car_model_id' => $aygo?->id, 'name' => '1.0L', 'code' => '1KR-FE', 'displacement' => 1.0, 'horsepower' => 68, 'kw' => 51, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2020],
            ];

            foreach ($engines as $engine) {
                if ($engine['car_model_id']) {
                    Engine::updateOrCreate(
                        ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                        $engine
                    );
                }
            }
        }

        // ==================== LEXUS ====================
        if ($lexus) {
            $rx = CarModel::where('car_make_id', $lexus->id)->where('name', 'LIKE', '%RX%')->first();
            $es = CarModel::where('car_make_id', $lexus->id)->where('name', 'LIKE', '%ES%')->first();
            $nx = CarModel::where('car_make_id', $lexus->id)->where('name', 'LIKE', '%NX%')->first();
            $lx = CarModel::where('car_make_id', $lexus->id)->where('name', 'LIKE', '%LX%')->first();
            $ux = CarModel::where('car_make_id', $lexus->id)->where('name', 'LIKE', '%UX%')->first();
            $is = CarModel::where('car_make_id', $lexus->id)->where('name', 'LIKE', '%IS%')->first();
            $ct = CarModel::where('car_make_id', $lexus->id)->where('name', 'LIKE', '%CT%')->first();
            $hs = CarModel::where('car_make_id', $lexus->id)->where('name', 'LIKE', '%HS%')->first();
            $gs = CarModel::where('car_make_id', $lexus->id)->where('name', 'LIKE', '%GS%')->first();

            $engines = [
                // RX
                ['car_model_id' => $rx?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 270, 'kw' => 201, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2015],
                ['car_model_id' => $rx?->id, 'name' => '3.5L V6 Hybrid', 'code' => '2GR-FXE', 'displacement' => 3.5, 'horsepower' => 295, 'kw' => 220, 'fuel_type' => 'Гибрид', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2015],
                ['car_model_id' => $rx?->id, 'name' => '2.0L Turbo', 'code' => '8AR-FTS', 'displacement' => 2.0, 'horsepower' => 235, 'kw' => 175, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => null],

                // ES
                ['car_model_id' => $es?->id, 'name' => '3.5L V6', 'code' => '2GR-FKS', 'displacement' => 3.5, 'horsepower' => 302, 'kw' => 225, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2018, 'year_to' => null],
                ['car_model_id' => $es?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 215, 'kw' => 160, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018, 'year_to' => null],
                ['car_model_id' => $es?->id, 'name' => '3.3L V6', 'code' => '3MZ-FE', 'displacement' => 3.3, 'horsepower' => 225, 'kw' => 168, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2006],

                // NX
                ['car_model_id' => $nx?->id, 'name' => '2.0L Turbo', 'code' => '8AR-FTS', 'displacement' => 2.0, 'horsepower' => 235, 'kw' => 175, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2014, 'year_to' => null],
                ['car_model_id' => $nx?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 194, 'kw' => 145, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2017, 'year_to' => null],

                // LX
                ['car_model_id' => $lx?->id, 'name' => '5.7L V8', 'code' => '3UR-FE', 'displacement' => 5.7, 'horsepower' => 383, 'kw' => 286, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2021],
                ['car_model_id' => $lx?->id, 'name' => '3.5L V6 Twin-Turbo', 'code' => 'V35A-FTS', 'displacement' => 3.5, 'horsepower' => 409, 'kw' => 305, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2021, 'year_to' => null],

                // CT200h
                ['car_model_id' => $ct?->id, 'name' => '1.8L Hybrid', 'code' => '2ZR-FXE', 'displacement' => 1.8, 'horsepower' => 134, 'kw' => 100, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => 2020],

                // HS250h
                ['car_model_id' => $hs?->id, 'name' => '2.4L Hybrid', 'code' => '2AZ-FXE', 'displacement' => 2.4, 'horsepower' => 187, 'kw' => 139, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2012],

                // GS
                ['car_model_id' => $gs?->id, 'name' => '3.0L V6', 'code' => '3GR-FE', 'displacement' => 3.0, 'horsepower' => 231, 'kw' => 172, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2011],
                ['car_model_id' => $gs?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 303, 'kw' => 226, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2011],

                // IS
                ['car_model_id' => $is?->id, 'name' => '2.5L V6', 'code' => '4GR-FSE', 'displacement' => 2.5, 'horsepower' => 208, 'kw' => 155, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2015],
                ['car_model_id' => $is?->id, 'name' => '3.5L V6', 'code' => '2GR-FSE', 'displacement' => 3.5, 'horsepower' => 306, 'kw' => 228, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2015],
                ['car_model_id' => $is?->id, 'name' => '2.0L', 'code' => '1G-FE', 'displacement' => 2.0, 'horsepower' => 155, 'kw' => 116, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2005],
                ['car_model_id' => $is?->id, 'name' => '3.0L', 'code' => '2JZ-GE', 'displacement' => 3.0, 'horsepower' => 215, 'kw' => 160, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2005],
            ];

            foreach ($engines as $engine) {
                if ($engine['car_model_id']) {
                    Engine::updateOrCreate(
                        ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                        $engine
                    );
                }
            }
        }

        // ==================== KIA ====================
        if ($kia) {
            $sportage = CarModel::where('car_make_id', $kia->id)->where('name', 'LIKE', '%Sportage%')->first();
            $ceed = CarModel::where('car_make_id', $kia->id)->where('name', 'LIKE', '%Ceed%')->first();
            $rio = CarModel::where('car_make_id', $kia->id)->where('name', 'LIKE', '%Rio%')->first();
            $sorento = CarModel::where('car_make_id', $kia->id)->where('name', 'LIKE', '%Sorento%')->first();
            $optima = CarModel::where('car_make_id', $kia->id)->where('name', 'LIKE', '%Optima%')->first();
            $stinger = CarModel::where('car_make_id', $kia->id)->where('name', 'LIKE', '%Stinger%')->first();

            $engines = [
                // Sportage
                ['car_model_id' => $sportage?->id, 'name' => '2.0L', 'code' => 'G4KD', 'displacement' => 2.0, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2010],
                ['car_model_id' => $sportage?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 177, 'kw' => 132, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => null],
                ['car_model_id' => $sportage?->id, 'name' => '2.0L CRDi', 'code' => 'D4HA', 'displacement' => 2.0, 'horsepower' => 185, 'kw' => 138, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2018],

                // Ceed
                ['car_model_id' => $ceed?->id, 'name' => '1.6L', 'code' => 'G4FC', 'displacement' => 1.6, 'horsepower' => 122, 'kw' => 91, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2012],
                ['car_model_id' => $ceed?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 204, 'kw' => 152, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013, 'year_to' => null],
                ['car_model_id' => $ceed?->id, 'name' => '1.6L CRDi', 'code' => 'D4FB', 'displacement' => 1.6, 'horsepower' => 115, 'kw' => 86, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2007, 'year_to' => 2015],

                // Rio
                ['car_model_id' => $rio?->id, 'name' => '1.4L', 'code' => 'G4LC', 'displacement' => 1.4, 'horsepower' => 100, 'kw' => 75, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2011, 'year_to' => null],
                ['car_model_id' => $rio?->id, 'name' => '1.6L', 'code' => 'G4FC', 'displacement' => 1.6, 'horsepower' => 123, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2017],
                ['car_model_id' => $rio?->id, 'name' => '1.4L CRDi', 'code' => 'D4FA', 'displacement' => 1.4, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2005, 'year_to' => 2011],

                // Sorento
                ['car_model_id' => $sorento?->id, 'name' => '2.4L', 'code' => 'G4KE', 'displacement' => 2.4, 'horsepower' => 172, 'kw' => 128, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2014],
                ['car_model_id' => $sorento?->id, 'name' => '2.2L CRDi', 'code' => 'D4HB', 'displacement' => 2.2, 'horsepower' => 200, 'kw' => 149, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2009, 'year_to' => null],
                ['car_model_id' => $sorento?->id, 'name' => '3.5L V6', 'code' => 'G6DC', 'displacement' => 3.5, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2015, 'year_to' => null],

                // Optima
                ['car_model_id' => $optima?->id, 'name' => '2.0L', 'code' => 'G4KD', 'displacement' => 2.0, 'horsepower' => 165, 'kw' => 123, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2010],
                ['car_model_id' => $optima?->id, 'name' => '2.0L Turbo', 'code' => 'G4KH', 'displacement' => 2.0, 'horsepower' => 245, 'kw' => 183, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2019],

                // Stinger
                ['car_model_id' => $stinger?->id, 'name' => '2.0L Turbo', 'code' => 'G4KL', 'displacement' => 2.0, 'horsepower' => 255, 'kw' => 190, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2017, 'year_to' => 2023],
                ['car_model_id' => $stinger?->id, 'name' => '3.3L V6 Twin-Turbo', 'code' => 'G6DP', 'displacement' => 3.3, 'horsepower' => 370, 'kw' => 276, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2017, 'year_to' => 2023],
            ];

            foreach ($engines as $engine) {
                if ($engine['car_model_id']) {
                    Engine::updateOrCreate(
                        ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                        $engine
                    );
                }
            }
        }

        // ==================== HYUNDAI ====================
        if ($hyundai) {
            $tucson = CarModel::where('car_make_id', $hyundai->id)->where('name', 'LIKE', '%Tucson%')->first();
            $santaFe = CarModel::where('car_make_id', $hyundai->id)->where('name', 'LIKE', '%Santa Fe%')->first();
            $elantra = CarModel::where('car_make_id', $hyundai->id)->where('name', 'LIKE', '%Elantra%')->first();
            $solaris = CarModel::where('car_make_id', $hyundai->id)->where('name', 'LIKE', '%Solaris%')->first();
            $i30 = CarModel::where('car_make_id', $hyundai->id)->where('name', 'LIKE', '%i30%')->first();
            $creta = CarModel::where('car_make_id', $hyundai->id)->where('name', 'LIKE', '%Creta%')->first();
            $palisade = CarModel::where('car_make_id', $hyundai->id)->where('name', 'LIKE', '%Palisade%')->first();

            $engines = [
                // Tucson
                ['car_model_id' => $tucson?->id, 'name' => '2.0L', 'code' => 'G4KD', 'displacement' => 2.0, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2010],
                ['car_model_id' => $tucson?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 177, 'kw' => 132, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => null],
                ['car_model_id' => $tucson?->id, 'name' => '2.0L CRDi', 'code' => 'D4HA', 'displacement' => 2.0, 'horsepower' => 185, 'kw' => 138, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2018],

                // Santa Fe
                ['car_model_id' => $santaFe?->id, 'name' => '2.4L', 'code' => 'G4KE', 'displacement' => 2.4, 'horsepower' => 172, 'kw' => 128, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2014],
                ['car_model_id' => $santaFe?->id, 'name' => '2.2L CRDi', 'code' => 'D4HB', 'displacement' => 2.2, 'horsepower' => 200, 'kw' => 149, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2009, 'year_to' => null],
                ['car_model_id' => $santaFe?->id, 'name' => '3.5L V6', 'code' => 'G6DC', 'displacement' => 3.5, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2015, 'year_to' => null],

                // Elantra
                ['car_model_id' => $elantra?->id, 'name' => '1.6L', 'code' => 'G4FG', 'displacement' => 1.6, 'horsepower' => 128, 'kw' => 95, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => null],
                ['car_model_id' => $elantra?->id, 'name' => '2.0L', 'code' => 'G4KD', 'displacement' => 2.0, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2010],
                ['car_model_id' => $elantra?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 204, 'kw' => 152, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013, 'year_to' => 2018],

                // Solaris
                ['car_model_id' => $solaris?->id, 'name' => '1.4L', 'code' => 'G4LC', 'displacement' => 1.4, 'horsepower' => 100, 'kw' => 75, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => null],
                ['car_model_id' => $solaris?->id, 'name' => '1.6L', 'code' => 'G4FC', 'displacement' => 1.6, 'horsepower' => 123, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => null],

                // i30
                ['car_model_id' => $i30?->id, 'name' => '1.6L', 'code' => 'G4FC', 'displacement' => 1.6, 'horsepower' => 122, 'kw' => 91, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2012],
                ['car_model_id' => $i30?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 204, 'kw' => 152, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013, 'year_to' => null],
                ['car_model_id' => $i30?->id, 'name' => '1.6L CRDi', 'code' => 'D4FB', 'displacement' => 1.6, 'horsepower' => 115, 'kw' => 86, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2007, 'year_to' => 2015],

                // Creta
                ['car_model_id' => $creta?->id, 'name' => '1.6L', 'code' => 'G4FG', 'displacement' => 1.6, 'horsepower' => 123, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2015, 'year_to' => null],
                ['car_model_id' => $creta?->id, 'name' => '1.4L Turbo', 'code' => 'G4LD', 'displacement' => 1.4, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019, 'year_to' => null],
                ['car_model_id' => $creta?->id, 'name' => '1.6L CRDi', 'code' => 'D4FB', 'displacement' => 1.6, 'horsepower' => 128, 'kw' => 95, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => 2020],

                // Palisade
                ['car_model_id' => $palisade?->id, 'name' => '3.8L V6', 'code' => 'G6DN', 'displacement' => 3.8, 'horsepower' => 291, 'kw' => 217, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2018, 'year_to' => null],
                ['car_model_id' => $palisade?->id, 'name' => '2.2L CRDi', 'code' => 'D4HB', 'displacement' => 2.2, 'horsepower' => 200, 'kw' => 149, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2018, 'year_to' => null],
            ];

            foreach ($engines as $engine) {
                if ($engine['car_model_id']) {
                    Engine::updateOrCreate(
                        ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                        $engine
                    );
                }
            }
        }

        // ==================== NISSAN ====================
        if ($nissan) {
            $qashqai = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Qashqai%')->first();
            $xterrain = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%X-Trail%')->first();
            $pathfinder = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Pathfinder%')->first();
            $patrol = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Patrol%')->first();
            $navara = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Navara%')->first();
            $juke = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Juke%')->first();
            $micra = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Micra%')->first();
            $note = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Note%')->first();
            $almera = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Almera%')->first();
            $primera = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Primera%')->first();
            $leaf = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Leaf%')->first();
            $gt_r = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%GT-R%')->first();
            $skyline = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Skyline%')->first();
            $fairlady = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Fairlady%')->first();
            $sentra = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Sentra%')->first();
            $versa = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Versa%')->first();
            $maxima = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Maxima%')->first();
            $altima = CarModel::where('car_make_id', $nissan->id)->where('name', 'LIKE', '%Altima%')->first();

            $engines = [
                // Qashqai
                ['car_model_id' => $qashqai?->id, 'name' => '1.2L DIG-T', 'code' => 'HRA2DDT', 'displacement' => 1.2, 'horsepower' => 115, 'kw' => 86, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013, 'year_to' => 2021],
                ['car_model_id' => $qashqai?->id, 'name' => '1.3L DIG-T', 'code' => 'HR13DDT', 'displacement' => 1.3, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2018, 'year_to' => null],
                ['car_model_id' => $qashqai?->id, 'name' => '1.5L dCi', 'code' => 'K9K', 'displacement' => 1.5, 'horsepower' => 110, 'kw' => 82, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2007, 'year_to' => 2021],
                ['car_model_id' => $qashqai?->id, 'name' => '1.6L', 'code' => 'HR16DE', 'displacement' => 1.6, 'horsepower' => 114, 'kw' => 85, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2013],

                // X-Trail
                ['car_model_id' => $xterrain?->id, 'name' => '2.0L', 'code' => 'MR20DE', 'displacement' => 2.0, 'horsepower' => 141, 'kw' => 105, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2013],
                ['car_model_id' => $xterrain?->id, 'name' => '2.5L', 'code' => 'QR25DE', 'displacement' => 2.5, 'horsepower' => 169, 'kw' => 126, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2013],
                ['car_model_id' => $xterrain?->id, 'name' => '1.6L dCi', 'code' => 'R9M', 'displacement' => 1.6, 'horsepower' => 130, 'kw' => 96, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013, 'year_to' => null],
                ['car_model_id' => $xterrain?->id, 'name' => '2.0L Hybrid', 'code' => 'MR20DDT', 'displacement' => 2.0, 'horsepower' => 147, 'kw' => 110, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2013, 'year_to' => 2021],

                // Pathfinder
                ['car_model_id' => $pathfinder?->id, 'name' => '3.5L V6', 'code' => 'VQ35DE', 'displacement' => 3.5, 'horsepower' => 240, 'kw' => 179, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2012],
                ['car_model_id' => $pathfinder?->id, 'name' => '4.0L V6', 'code' => 'VQ40DE', 'displacement' => 4.0, 'horsepower' => 266, 'kw' => 198, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2012],
                ['car_model_id' => $pathfinder?->id, 'name' => '2.5L dCi', 'code' => 'YD25DDTi', 'displacement' => 2.5, 'horsepower' => 171, 'kw' => 128, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2004, 'year_to' => 2012],

                // Patrol
                ['car_model_id' => $patrol?->id, 'name' => '4.8L V6', 'code' => 'TB48DE', 'displacement' => 4.8, 'horsepower' => 245, 'kw' => 183, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2010],
                ['car_model_id' => $patrol?->id, 'name' => '4.5L V8', 'code' => 'VK45DE', 'displacement' => 4.5, 'horsepower' => 280, 'kw' => 209, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => 2019],
                ['car_model_id' => $patrol?->id, 'name' => '5.6L V8', 'code' => 'VK56VD', 'displacement' => 5.6, 'horsepower' => 400, 'kw' => 298, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => null],
                ['car_model_id' => $patrol?->id, 'name' => '3.0L dCi', 'code' => 'ZD30DDTi', 'displacement' => 3.0, 'horsepower' => 160, 'kw' => 119, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2000, 'year_to' => 2010],

                // Navara
                ['car_model_id' => $navara?->id, 'name' => '2.5L dCi', 'code' => 'YD25DDTi', 'displacement' => 2.5, 'horsepower' => 163, 'kw' => 122, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2005, 'year_to' => 2015],
                ['car_model_id' => $navara?->id, 'name' => '3.0L dCi', 'code' => 'V9X', 'displacement' => 3.0, 'horsepower' => 231, 'kw' => 172, 'fuel_type' => 'Дизель', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2015],
                ['car_model_id' => $navara?->id, 'name' => '2.5L', 'code' => 'QR25DE', 'displacement' => 2.5, 'horsepower' => 152, 'kw' => 113, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2015],

                // Juke
                ['car_model_id' => $juke?->id, 'name' => '1.6L', 'code' => 'HR16DE', 'displacement' => 1.6, 'horsepower' => 117, 'kw' => 87, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => 2019],
                ['car_model_id' => $juke?->id, 'name' => '1.6L DIG-T', 'code' => 'MR16DDT', 'displacement' => 1.6, 'horsepower' => 190, 'kw' => 142, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2019],
                ['car_model_id' => $juke?->id, 'name' => '1.5L dCi', 'code' => 'K9K', 'displacement' => 1.5, 'horsepower' => 110, 'kw' => 82, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2019],

                // Micra
                ['car_model_id' => $micra?->id, 'name' => '1.2L', 'code' => 'HR12DE', 'displacement' => 1.2, 'horsepower' => 80, 'kw' => 60, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => null],
                ['car_model_id' => $micra?->id, 'name' => '1.2L DIG-S', 'code' => 'HR12DDR', 'displacement' => 1.2, 'horsepower' => 98, 'kw' => 73, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Компрессор', 'year_from' => 2011, 'year_to' => 2017],
                ['car_model_id' => $micra?->id, 'name' => '1.5L dCi', 'code' => 'K9K', 'displacement' => 1.5, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2003, 'year_to' => 2010],

                // Note
                ['car_model_id' => $note?->id, 'name' => '1.2L', 'code' => 'HR12DE', 'displacement' => 1.2, 'horsepower' => 80, 'kw' => 60, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2012, 'year_to' => null],
                ['car_model_id' => $note?->id, 'name' => '1.2L DIG-S', 'code' => 'HR12DDR', 'displacement' => 1.2, 'horsepower' => 98, 'kw' => 73, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Компрессор', 'year_from' => 2012, 'year_to' => 2020],

                // Almera
                ['car_model_id' => $almera?->id, 'name' => '1.5L', 'code' => 'HR15DE', 'displacement' => 1.5, 'horsepower' => 105, 'kw' => 78, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2006],
                ['car_model_id' => $almera?->id, 'name' => '1.8L', 'code' => 'QG18DE', 'displacement' => 1.8, 'horsepower' => 116, 'kw' => 87, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2006],
                ['car_model_id' => $almera?->id, 'name' => '1.5L dCi', 'code' => 'K9K', 'displacement' => 1.5, 'horsepower' => 82, 'kw' => 61, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2003, 'year_to' => 2006],

                // Primera
                ['car_model_id' => $primera?->id, 'name' => '1.6L', 'code' => 'QG16DE', 'displacement' => 1.6, 'horsepower' => 109, 'kw' => 81, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2002],
                ['car_model_id' => $primera?->id, 'name' => '1.8L', 'code' => 'QG18DE', 'displacement' => 1.8, 'horsepower' => 116, 'kw' => 87, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2002],
                ['car_model_id' => $primera?->id, 'name' => '2.0L', 'code' => 'SR20DE', 'displacement' => 2.0, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2002],

                // GT-R
                ['car_model_id' => $gt_r?->id, 'name' => '3.8L V6 Twin-Turbo', 'code' => 'VR38DETT', 'displacement' => 3.8, 'horsepower' => 480, 'kw' => 358, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2007, 'year_to' => null],

                // 370Z / Fairlady
                ['car_model_id' => $fairlady?->id, 'name' => '3.7L V6', 'code' => 'VQ37VHR', 'displacement' => 3.7, 'horsepower' => 328, 'kw' => 245, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2008, 'year_to' => 2020],

                // Sentra
                ['car_model_id' => $sentra?->id, 'name' => '1.6L', 'code' => 'HR16DE', 'displacement' => 1.6, 'horsepower' => 117, 'kw' => 87, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2013, 'year_to' => null],
                ['car_model_id' => $sentra?->id, 'name' => '1.8L', 'code' => 'MRA8DE', 'displacement' => 1.8, 'horsepower' => 130, 'kw' => 97, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2012],

                // Maxima
                ['car_model_id' => $maxima?->id, 'name' => '3.5L V6', 'code' => 'VQ35DE', 'displacement' => 3.5, 'horsepower' => 265, 'kw' => 198, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2008],
                ['car_model_id' => $maxima?->id, 'name' => '3.5L V6', 'code' => 'VQ35HR', 'displacement' => 3.5, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2014],

                // Altima
                ['car_model_id' => $altima?->id, 'name' => '2.5L', 'code' => 'QR25DE', 'displacement' => 2.5, 'horsepower' => 175, 'kw' => 130, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2012],
                ['car_model_id' => $altima?->id, 'name' => '3.5L V6', 'code' => 'VQ35DE', 'displacement' => 3.5, 'horsepower' => 270, 'kw' => 201, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2012],
            ];

            foreach ($engines as $engine) {
                if ($engine['car_model_id']) {
                    Engine::updateOrCreate(
                        ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                        $engine
                    );
                }
            }
        }

        $this->command->info('Engines seeded successfully!');
    }
}
