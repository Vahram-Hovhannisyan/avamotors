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

            $engines = [
                // Camry
                ['car_model_id' => $camry?->id, 'name' => '2.5L Dynamic Force', 'code' => 'A25A-FKS', 'displacement' => 2.5, 'horsepower' => 203, 'kw' => 151, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2017, 'year_to' => null],
                ['car_model_id' => $camry?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 268, 'kw' => 200, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2017],
                ['car_model_id' => $camry?->id, 'name' => '2.0L', 'code' => '1AZ-FE', 'displacement' => 2.0, 'horsepower' => 147, 'kw' => 110, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2012],
                ['car_model_id' => $camry?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 158, 'kw' => 118, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2002, 'year_to' => 2011],

                // Corolla
                ['car_model_id' => $corolla?->id, 'name' => '1.8L', 'code' => '2ZR-FE', 'displacement' => 1.8, 'horsepower' => 132, 'kw' => 98, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => null],
                ['car_model_id' => $corolla?->id, 'name' => '1.6L', 'code' => '1ZR-FE', 'displacement' => 1.6, 'horsepower' => 122, 'kw' => 91, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => null],
                ['car_model_id' => $corolla?->id, 'name' => '2.0L Hybrid', 'code' => '2ZR-FXE', 'displacement' => 1.8, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018, 'year_to' => null],
                ['car_model_id' => $corolla?->id, 'name' => '1.4L D-4D', 'code' => '1ND-TV', 'displacement' => 1.4, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2004, 'year_to' => 2013],

                // RAV4
                ['car_model_id' => $rav4?->id, 'name' => '2.0L', 'code' => '3ZR-FE', 'displacement' => 2.0, 'horsepower' => 146, 'kw' => 109, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2015],
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
                ['car_model_id' => $highlander?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 243, 'kw' => 181, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2020, 'year_to' => null],
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

            $engines = [
                // RX
                ['car_model_id' => $rx?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 270, 'kw' => 201, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2015],
                ['car_model_id' => $rx?->id, 'name' => '3.5L V6 Hybrid', 'code' => '2GR-FXE', 'displacement' => 3.5, 'horsepower' => 295, 'kw' => 220, 'fuel_type' => 'Гибрид', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2015],
                ['car_model_id' => $rx?->id, 'name' => '2.0L Turbo', 'code' => '8AR-FTS', 'displacement' => 2.0, 'horsepower' => 235, 'kw' => 175, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => null],

                // ES
                ['car_model_id' => $es?->id, 'name' => '3.5L V6', 'code' => '2GR-FKS', 'displacement' => 3.5, 'horsepower' => 302, 'kw' => 225, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2018, 'year_to' => null],
                ['car_model_id' => $es?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 215, 'kw' => 160, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018, 'year_to' => null],

                // NX
                ['car_model_id' => $nx?->id, 'name' => '2.0L Turbo', 'code' => '8AR-FTS', 'displacement' => 2.0, 'horsepower' => 235, 'kw' => 175, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2014, 'year_to' => null],
                ['car_model_id' => $nx?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 194, 'kw' => 145, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2017, 'year_to' => null],

                // LX
                ['car_model_id' => $lx?->id, 'name' => '5.7L V8', 'code' => '3UR-FE', 'displacement' => 5.7, 'horsepower' => 383, 'kw' => 286, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2021],
                ['car_model_id' => $lx?->id, 'name' => '3.5L V6 Twin-Turbo', 'code' => 'V35A-FTS', 'displacement' => 3.5, 'horsepower' => 409, 'kw' => 305, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Твин-турбо', 'year_from' => 2021, 'year_to' => null],
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

        $this->command->info('Engines seeded successfully!');
    }
}
