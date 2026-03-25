<?php

namespace Database\Seeders\Engines;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Engine;

class HyundaiEngineSeeder extends Seeder
{
    public function run(): void
    {
        $hyundai = CarMake::where('name', 'Hyundai')->first();

        if (!$hyundai) {
            $this->command->error('Hyundai not found!');
            return;
        }

        $models = [
            'Accent' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Accent')->first(),
            'Solaris' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Solaris')->first(),
            'Elantra' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Elantra')->first(),
            'Sonata' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Sonata')->first(),
            'Tucson' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Tucson')->first(),
            'Santa Fe' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Santa Fe')->first(),
            'Creta' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Creta')->first(),
            'Kona' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Kona')->first(),
            'i30' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'i30')->first(),
            'i20' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'i20')->first(),
            'i10' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'i10')->first(),
            'Palisade' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Palisade')->first(),
            'Grandeur' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Grandeur')->first(),
            'Genesis' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Genesis')->first(),
            'Veloster' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'Veloster')->first(),
            'IONIQ 5' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'IONIQ 5')->first(),
            'IONIQ 6' => CarModel::where('car_make_id', $hyundai->id)->where('name', 'IONIQ 6')->first(),
        ];

        $engines = [
            // ==================== Бензиновые двигатели серии Alpha (1.4 - 1.6) ====================
            ['car_model_id' => $models['Accent']?->id, 'name' => '1.4L', 'code' => 'G4LC', 'displacement' => 1.4, 'horsepower' => 100, 'kw' => 75, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010],
            ['car_model_id' => $models['Solaris']?->id, 'name' => '1.4L', 'code' => 'G4LC', 'displacement' => 1.4, 'horsepower' => 100, 'kw' => 75, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010],
            ['car_model_id' => $models['i10']?->id, 'name' => '1.2L', 'code' => 'G4LA', 'displacement' => 1.2, 'horsepower' => 87, 'kw' => 65, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2014],
            ['car_model_id' => $models['i20']?->id, 'name' => '1.2L', 'code' => 'G4LA', 'displacement' => 1.2, 'horsepower' => 87, 'kw' => 65, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2015],
            ['car_model_id' => $models['Accent']?->id, 'name' => '1.6L', 'code' => 'G4FC', 'displacement' => 1.6, 'horsepower' => 123, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2017],
            ['car_model_id' => $models['Solaris']?->id, 'name' => '1.6L', 'code' => 'G4FC', 'displacement' => 1.6, 'horsepower' => 123, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010],
            ['car_model_id' => $models['i30']?->id, 'name' => '1.6L', 'code' => 'G4FC', 'displacement' => 1.6, 'horsepower' => 122, 'kw' => 91, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2012],

            // ==================== Серия Gamma (1.6) ====================
            ['car_model_id' => $models['Elantra']?->id, 'name' => '1.6L', 'code' => 'G4FG', 'displacement' => 1.6, 'horsepower' => 128, 'kw' => 95, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010],
            ['car_model_id' => $models['i30']?->id, 'name' => '1.6L', 'code' => 'G4FG', 'displacement' => 1.6, 'horsepower' => 130, 'kw' => 97, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2012],
            ['car_model_id' => $models['Creta']?->id, 'name' => '1.6L', 'code' => 'G4FG', 'displacement' => 1.6, 'horsepower' => 123, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2015],
            ['car_model_id' => $models['Kona']?->id, 'name' => '1.6L', 'code' => 'G4FG', 'displacement' => 1.6, 'horsepower' => 123, 'kw' => 92, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2017],

            // ==================== Турбированные Gamma (1.6 T-GDI) ====================
            ['car_model_id' => $models['Elantra']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 204, 'kw' => 152, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013, 'year_to' => 2018],
            ['car_model_id' => $models['i30']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 204, 'kw' => 152, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013],
            ['car_model_id' => $models['Tucson']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 177, 'kw' => 132, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015],
            ['car_model_id' => $models['Kona']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 195, 'kw' => 145, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2017],
            ['car_model_id' => $models['Veloster']?->id, 'name' => '1.6L Turbo', 'code' => 'G4FJ', 'displacement' => 1.6, 'horsepower' => 201, 'kw' => 150, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2012, 'year_to' => 2018],

            // ==================== Серия Beta (1.8 - 2.0) ====================
            ['car_model_id' => $models['Elantra']?->id, 'name' => '1.8L', 'code' => 'G4GB', 'displacement' => 1.8, 'horsepower' => 132, 'kw' => 98, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2006],
            ['car_model_id' => $models['Elantra']?->id, 'name' => '2.0L', 'code' => 'G4GC', 'displacement' => 2.0, 'horsepower' => 138, 'kw' => 103, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2006],

            // ==================== Серия Theta (2.0 - 2.4) ====================
            ['car_model_id' => $models['Elantra']?->id, 'name' => '2.0L', 'code' => 'G4KD', 'displacement' => 2.0, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2010],
            ['car_model_id' => $models['Sonata']?->id, 'name' => '2.0L', 'code' => 'G4KD', 'displacement' => 2.0, 'horsepower' => 165, 'kw' => 123, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2010],
            ['car_model_id' => $models['Tucson']?->id, 'name' => '2.0L', 'code' => 'G4KD', 'displacement' => 2.0, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2004, 'year_to' => 2010],
            ['car_model_id' => $models['Elantra']?->id, 'name' => '2.0L', 'code' => 'G4NA', 'displacement' => 2.0, 'horsepower' => 147, 'kw' => 110, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010],
            ['car_model_id' => $models['Sonata']?->id, 'name' => '2.4L', 'code' => 'G4KE', 'displacement' => 2.4, 'horsepower' => 172, 'kw' => 128, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2014],
            ['car_model_id' => $models['Santa Fe']?->id, 'name' => '2.4L', 'code' => 'G4KE', 'displacement' => 2.4, 'horsepower' => 172, 'kw' => 128, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2009, 'year_to' => 2014],
            ['car_model_id' => $models['Tucson']?->id, 'name' => '2.0L', 'code' => 'G4NA', 'displacement' => 2.0, 'horsepower' => 155, 'kw' => 116, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2015],

            // ==================== Турбированные Theta (2.0 T-GDI) ====================
            ['car_model_id' => $models['Sonata']?->id, 'name' => '2.0L Turbo', 'code' => 'G4KH', 'displacement' => 2.0, 'horsepower' => 245, 'kw' => 183, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2019],
            ['car_model_id' => $models['Elantra']?->id, 'name' => '2.0L Turbo', 'code' => 'G4KH', 'displacement' => 2.0, 'horsepower' => 275, 'kw' => 205, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['Santa Fe']?->id, 'name' => '2.0L Turbo', 'code' => 'G4KH', 'displacement' => 2.0, 'horsepower' => 240, 'kw' => 179, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2013],
            ['car_model_id' => $models['Tucson']?->id, 'name' => '2.0L Turbo', 'code' => 'G4KH', 'displacement' => 2.0, 'horsepower' => 175, 'kw' => 130, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],

            // ==================== Серия Smartstream (1.4 - 1.6) ====================
            ['car_model_id' => $models['i10']?->id, 'name' => '1.0L', 'code' => 'G3LA', 'displacement' => 1.0, 'horsepower' => 66, 'kw' => 49, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2020],
            ['car_model_id' => $models['Creta']?->id, 'name' => '1.4L Turbo', 'code' => 'G4LD', 'displacement' => 1.4, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['Kona']?->id, 'name' => '1.4L Turbo', 'code' => 'G4LD', 'displacement' => 1.4, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2019],

            // ==================== V6 двигатели (Lambda) ====================
            ['car_model_id' => $models['Sonata']?->id, 'name' => '3.3L V6', 'code' => 'G6DB', 'displacement' => 3.3, 'horsepower' => 235, 'kw' => 175, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2010],
            ['car_model_id' => $models['Santa Fe']?->id, 'name' => '3.3L V6', 'code' => 'G6DB', 'displacement' => 3.3, 'horsepower' => 242, 'kw' => 180, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2012],
            ['car_model_id' => $models['Santa Fe']?->id, 'name' => '3.5L V6', 'code' => 'G6DC', 'displacement' => 3.5, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2015],
            ['car_model_id' => $models['Palisade']?->id, 'name' => '3.8L V6', 'code' => 'G6DN', 'displacement' => 3.8, 'horsepower' => 291, 'kw' => 217, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2018],
            ['car_model_id' => $models['Grandeur']?->id, 'name' => '3.5L V6', 'code' => 'G6DC', 'displacement' => 3.5, 'horsepower' => 290, 'kw' => 216, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2017],
            ['car_model_id' => $models['Genesis']?->id, 'name' => '3.8L V6', 'code' => 'G6DJ', 'displacement' => 3.8, 'horsepower' => 333, 'kw' => 248, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2008, 'year_to' => 2016],

            // ==================== Дизельные двигатели (CRDi) ====================
            ['car_model_id' => $models['Accent']?->id, 'name' => '1.4L CRDi', 'code' => 'D4FA', 'displacement' => 1.4, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2005, 'year_to' => 2011],
            ['car_model_id' => $models['i20']?->id, 'name' => '1.4L CRDi', 'code' => 'D4FA', 'displacement' => 1.4, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2008, 'year_to' => 2015],
            ['car_model_id' => $models['i30']?->id, 'name' => '1.6L CRDi', 'code' => 'D4FB', 'displacement' => 1.6, 'horsepower' => 115, 'kw' => 86, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2007, 'year_to' => 2015],
            ['car_model_id' => $models['Elantra']?->id, 'name' => '1.6L CRDi', 'code' => 'D4FB', 'displacement' => 1.6, 'horsepower' => 128, 'kw' => 95, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2015],
            ['car_model_id' => $models['Creta']?->id, 'name' => '1.6L CRDi', 'code' => 'D4FB', 'displacement' => 1.6, 'horsepower' => 128, 'kw' => 95, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015, 'year_to' => 2020],
            ['car_model_id' => $models['Tucson']?->id, 'name' => '2.0L CRDi', 'code' => 'D4HA', 'displacement' => 2.0, 'horsepower' => 185, 'kw' => 138, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2010, 'year_to' => 2018],
            ['car_model_id' => $models['Santa Fe']?->id, 'name' => '2.2L CRDi', 'code' => 'D4HB', 'displacement' => 2.2, 'horsepower' => 200, 'kw' => 149, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2009],
            ['car_model_id' => $models['Grandeur']?->id, 'name' => '2.2L CRDi', 'code' => 'D4HB', 'displacement' => 2.2, 'horsepower' => 200, 'kw' => 149, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2012],
            ['car_model_id' => $models['Palisade']?->id, 'name' => '2.2L CRDi', 'code' => 'D4HB', 'displacement' => 2.2, 'horsepower' => 200, 'kw' => 149, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2018],

            // ==================== Электромоторы ====================
            ['car_model_id' => $models['Kona']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 136, 'kw' => 101, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2018, 'year_to' => 2021],
            ['car_model_id' => $models['Kona']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 201, 'kw' => 150, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['IONIQ 5']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 168, 'kw' => 125, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['IONIQ 5']?->id, 'name' => 'Electric AWD', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 320, 'kw' => 239, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['IONIQ 6']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 225, 'kw' => 168, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2022],
        ];

        foreach ($engines as $engine) {
            if ($engine['car_model_id']) {
                Engine::updateOrCreate(
                    ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                    $engine
                );
            }
        }

        $this->command->info('✓ Hyundai engines seeded: ' . count($engines));
    }
}
