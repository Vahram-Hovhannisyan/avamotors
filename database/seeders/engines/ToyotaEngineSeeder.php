<?php

namespace Database\Seeders\Engines;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Engine;

class ToyotaEngineSeeder extends Seeder
{
    public function run(): void
    {
        $toyota = CarMake::where('name', 'Toyota')->first();

        if (!$toyota) {
            $this->command->error('Toyota not found!');
            return;
        }

        $models = [
            'Camry' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Camry')->first(),
            'Corolla' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Corolla')->first(),
            'RAV4' => CarModel::where('car_make_id', $toyota->id)->where('name', 'RAV4')->first(),
            'Land Cruiser' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Land Cruiser')->first(),
            'Land Cruiser Prado' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Land Cruiser Prado')->first(),
            'Prius' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Prius')->first(),
            'Highlander' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Highlander')->first(),
            'Yaris' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Yaris')->first(),
            'Auris' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Auris')->first(),
            'Avensis' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Avensis')->first(),
            'Hilux' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Hilux')->first(),
            'Supra' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Supra')->first(),
            'GR86' => CarModel::where('car_make_id', $toyota->id)->where('name', 'GR86')->first(),
            'GR Yaris' => CarModel::where('car_make_id', $toyota->id)->where('name', 'GR Yaris')->first(),
            'GR Corolla' => CarModel::where('car_make_id', $toyota->id)->where('name', 'GR Corolla')->first(),
            'C-HR' => CarModel::where('car_make_id', $toyota->id)->where('name', 'C-HR')->first(),
            'Alphard' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Alphard')->first(),
            'Sienna' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Sienna')->first(),
            'Tundra' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Tundra')->first(),
            'Tacoma' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Tacoma')->first(),
            '4Runner' => CarModel::where('car_make_id', $toyota->id)->where('name', '4Runner')->first(),
            'Sequoia' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Sequoia')->first(),
            'FJ Cruiser' => CarModel::where('car_make_id', $toyota->id)->where('name', 'FJ Cruiser')->first(),
            'Crown' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Crown')->first(),
            'bZ4X' => CarModel::where('car_make_id', $toyota->id)->where('name', 'bZ4X')->first(),
            'Mirai' => CarModel::where('car_make_id', $toyota->id)->where('name', 'Mirai')->first(),
        ];

        $engines = [
            // ==================== Серия A (старые 4-цилиндровые) ====================
            ['car_model_id' => $models['Corolla']?->id, 'name' => '1.3L', 'code' => '4A-FE', 'displacement' => 1.3, 'horsepower' => 88, 'kw' => 66, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1987, 'year_to' => 1997],
            ['car_model_id' => $models['Corolla']?->id, 'name' => '1.6L', 'code' => '4A-GE', 'displacement' => 1.6, 'horsepower' => 120, 'kw' => 90, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1983, 'year_to' => 1997],
            ['car_model_id' => $models['Corolla']?->id, 'name' => '1.6L Supercharged', 'code' => '4A-GZE', 'displacement' => 1.6, 'horsepower' => 165, 'kw' => 123, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Компрессор', 'year_from' => 1987, 'year_to' => 1995],

            // ==================== Серия S (1.8 - 2.0) ====================
            ['car_model_id' => $models['Corolla']?->id, 'name' => '1.8L', 'code' => '1ZZ-FE', 'displacement' => 1.8, 'horsepower' => 132, 'kw' => 98, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1998, 'year_to' => 2008],
            ['car_model_id' => $models['Corolla']?->id, 'name' => '1.8L', 'code' => '2ZR-FE', 'displacement' => 1.8, 'horsepower' => 132, 'kw' => 98, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006],
            ['car_model_id' => $models['Corolla']?->id, 'name' => '1.6L', 'code' => '1ZR-FE', 'displacement' => 1.6, 'horsepower' => 122, 'kw' => 91, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006],
            ['car_model_id' => $models['Corolla']?->id, 'name' => '1.6L', 'code' => '3ZZ-FE', 'displacement' => 1.6, 'horsepower' => 110, 'kw' => 82, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2008],
            ['car_model_id' => $models['Auris']?->id, 'name' => '1.6L', 'code' => '1ZR-FE', 'displacement' => 1.6, 'horsepower' => 122, 'kw' => 91, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006],
            ['car_model_id' => $models['Auris']?->id, 'name' => '1.8L', 'code' => '2ZR-FE', 'displacement' => 1.8, 'horsepower' => 136, 'kw' => 101, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006],

            // ==================== Серия AZ (2.0 - 2.4) ====================
            ['car_model_id' => $models['Camry']?->id, 'name' => '2.0L', 'code' => '1AZ-FE', 'displacement' => 2.0, 'horsepower' => 147, 'kw' => 110, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2012],
            ['car_model_id' => $models['RAV4']?->id, 'name' => '2.0L', 'code' => '1AZ-FE', 'displacement' => 2.0, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2000, 'year_to' => 2005],
            ['car_model_id' => $models['Avensis']?->id, 'name' => '2.0L', 'code' => '1AZ-FE', 'displacement' => 2.0, 'horsepower' => 147, 'kw' => 110, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2008],
            ['car_model_id' => $models['Camry']?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 158, 'kw' => 118, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2002, 'year_to' => 2011],
            ['car_model_id' => $models['RAV4']?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 166, 'kw' => 124, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2012],
            ['car_model_id' => $models['Highlander']?->id, 'name' => '2.4L', 'code' => '2AZ-FE', 'displacement' => 2.4, 'horsepower' => 160, 'kw' => 119, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2001, 'year_to' => 2007],
            ['car_model_id' => $models['Camry']?->id, 'name' => '2.4L Hybrid', 'code' => '2AZ-FXE', 'displacement' => 2.4, 'horsepower' => 147, 'kw' => 110, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2011],

            // ==================== Серия AR (2.5 - 2.7) ====================
            ['car_model_id' => $models['Camry']?->id, 'name' => '2.5L', 'code' => '2AR-FE', 'displacement' => 2.5, 'horsepower' => 178, 'kw' => 133, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => 2017],
            ['car_model_id' => $models['RAV4']?->id, 'name' => '2.5L', 'code' => '2AR-FE', 'displacement' => 2.5, 'horsepower' => 176, 'kw' => 131, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2012, 'year_to' => 2018],
            ['car_model_id' => $models['Highlander']?->id, 'name' => '2.7L', 'code' => '2AR-FE', 'displacement' => 2.7, 'horsepower' => 185, 'kw' => 138, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2010, 'year_to' => 2019],
            ['car_model_id' => $models['Camry']?->id, 'name' => '2.5L Dynamic Force', 'code' => 'A25A-FKS', 'displacement' => 2.5, 'horsepower' => 203, 'kw' => 151, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2017],
            ['car_model_id' => $models['RAV4']?->id, 'name' => '2.5L', 'code' => 'A25A-FKS', 'displacement' => 2.5, 'horsepower' => 203, 'kw' => 151, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018],
            ['car_model_id' => $models['Camry']?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 208, 'kw' => 155, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2017],
            ['car_model_id' => $models['RAV4']?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 219, 'kw' => 163, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018],

            // ==================== Серия GR V6 (3.0 - 3.5) ====================
            ['car_model_id' => $models['Camry']?->id, 'name' => '3.0L V6', 'code' => '1MZ-FE', 'displacement' => 3.0, 'horsepower' => 190, 'kw' => 142, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 1997, 'year_to' => 2006],
            ['car_model_id' => $models['Camry']?->id, 'name' => '3.3L V6', 'code' => '3MZ-FE', 'displacement' => 3.3, 'horsepower' => 225, 'kw' => 168, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2006],
            ['car_model_id' => $models['Camry']?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 268, 'kw' => 200, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2017],
            ['car_model_id' => $models['Camry']?->id, 'name' => '3.5L V6', 'code' => '2GR-FKS', 'displacement' => 3.5, 'horsepower' => 301, 'kw' => 224, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2017],
            ['car_model_id' => $models['Highlander']?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 270, 'kw' => 201, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2007, 'year_to' => 2013],
            ['car_model_id' => $models['Highlander']?->id, 'name' => '3.5L V6', 'code' => '2GR-FKS', 'displacement' => 3.5, 'horsepower' => 295, 'kw' => 220, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2016],
            ['car_model_id' => $models['Sienna']?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 266, 'kw' => 198, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2006, 'year_to' => 2020],
            ['car_model_id' => $models['Alphard']?->id, 'name' => '3.5L V6', 'code' => '2GR-FE', 'displacement' => 3.5, 'horsepower' => 276, 'kw' => 206, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2008, 'year_to' => 2015],

            // ==================== Серия UR V8 (4.6 - 5.7) ====================
            ['car_model_id' => $models['Land Cruiser']?->id, 'name' => '4.6L V8', 'code' => '1UR-FE', 'displacement' => 4.6, 'horsepower' => 309, 'kw' => 230, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2007],
            ['car_model_id' => $models['Land Cruiser']?->id, 'name' => '5.7L V8', 'code' => '3UR-FE', 'displacement' => 5.7, 'horsepower' => 381, 'kw' => 284, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2007],
            ['car_model_id' => $models['Tundra']?->id, 'name' => '5.7L V8', 'code' => '3UR-FE', 'displacement' => 5.7, 'horsepower' => 381, 'kw' => 284, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2007],
            ['car_model_id' => $models['Sequoia']?->id, 'name' => '5.7L V8', 'code' => '3UR-FE', 'displacement' => 5.7, 'horsepower' => 381, 'kw' => 284, 'fuel_type' => 'Бензин', 'cylinders' => 8, 'turbo' => 'Атмосферный', 'year_from' => 2007],
            ['car_model_id' => $models['Land Cruiser']?->id, 'name' => '4.5L V8 Diesel', 'code' => '1VD-FTV', 'displacement' => 4.5, 'horsepower' => 202, 'kw' => 151, 'fuel_type' => 'Дизель', 'cylinders' => 8, 'turbo' => 'Турбо', 'year_from' => 2007],

            // ==================== Дизельные двигатели ====================
            ['car_model_id' => $models['Land Cruiser']?->id, 'name' => '3.0L D-4D', 'code' => '1KD-FTV', 'displacement' => 3.0, 'horsepower' => 163, 'kw' => 122, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2000, 'year_to' => 2009],
            ['car_model_id' => $models['Land Cruiser Prado']?->id, 'name' => '3.0L D-4D', 'code' => '1KD-FTV', 'displacement' => 3.0, 'horsepower' => 163, 'kw' => 122, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2000, 'year_to' => 2009],
            ['car_model_id' => $models['Hilux']?->id, 'name' => '3.0L D-4D', 'code' => '1KD-FTV', 'displacement' => 3.0, 'horsepower' => 163, 'kw' => 122, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2001, 'year_to' => 2015],
            ['car_model_id' => $models['Hilux']?->id, 'name' => '2.8L D-4D', 'code' => '1GD-FTV', 'displacement' => 2.8, 'horsepower' => 177, 'kw' => 132, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015],
            ['car_model_id' => $models['Hilux']?->id, 'name' => '2.4L D-4D', 'code' => '2GD-FTV', 'displacement' => 2.4, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015],
            ['car_model_id' => $models['Land Cruiser Prado']?->id, 'name' => '2.8L D-4D', 'code' => '1GD-FTV', 'displacement' => 2.8, 'horsepower' => 201, 'kw' => 150, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2015],
            ['car_model_id' => $models['Corolla']?->id, 'name' => '1.4L D-4D', 'code' => '1ND-TV', 'displacement' => 1.4, 'horsepower' => 90, 'kw' => 67, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2004, 'year_to' => 2013],
            ['car_model_id' => $models['Avensis']?->id, 'name' => '2.0L D-4D', 'code' => '1AD-FTV', 'displacement' => 2.0, 'horsepower' => 126, 'kw' => 94, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2005, 'year_to' => 2015],
            ['car_model_id' => $models['Avensis']?->id, 'name' => '2.2L D-4D', 'code' => '2AD-FTV', 'displacement' => 2.2, 'horsepower' => 150, 'kw' => 112, 'fuel_type' => 'Дизель', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2005, 'year_to' => 2015],

            // ==================== Гибридные двигатели ====================
            ['car_model_id' => $models['Prius']?->id, 'name' => '1.5L Hybrid', 'code' => '1NZ-FXE', 'displacement' => 1.5, 'horsepower' => 76, 'kw' => 57, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2003, 'year_to' => 2009],
            ['car_model_id' => $models['Prius']?->id, 'name' => '1.8L Hybrid', 'code' => '2ZR-FXE', 'displacement' => 1.8, 'horsepower' => 98, 'kw' => 73, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2009],
            ['car_model_id' => $models['Corolla']?->id, 'name' => '1.8L Hybrid', 'code' => '2ZR-FXE', 'displacement' => 1.8, 'horsepower' => 140, 'kw' => 104, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018],
            ['car_model_id' => $models['C-HR']?->id, 'name' => '1.8L Hybrid', 'code' => '2ZR-FXE', 'displacement' => 1.8, 'horsepower' => 122, 'kw' => 91, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2016],
            ['car_model_id' => $models['RAV4']?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 219, 'kw' => 163, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2018],
            ['car_model_id' => $models['Highlander']?->id, 'name' => '2.5L Hybrid', 'code' => 'A25A-FXS', 'displacement' => 2.5, 'horsepower' => 243, 'kw' => 181, 'fuel_type' => 'Гибрид', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2020],
            ['car_model_id' => $models['Highlander']?->id, 'name' => '3.5L V6 Hybrid', 'code' => '2GR-FXE', 'displacement' => 3.5, 'horsepower' => 306, 'kw' => 228, 'fuel_type' => 'Гибрид', 'cylinders' => 6, 'turbo' => 'Атмосферный', 'year_from' => 2005, 'year_to' => 2013],

            // ==================== Спортивные двигатели ====================
            ['car_model_id' => $models['Supra']?->id, 'name' => '3.0L Turbo', 'code' => 'B58', 'displacement' => 3.0, 'horsepower' => 335, 'kw' => 250, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2019],
            ['car_model_id' => $models['Supra']?->id, 'name' => '3.0L Turbo', 'code' => 'B58', 'displacement' => 3.0, 'horsepower' => 382, 'kw' => 285, 'fuel_type' => 'Бензин', 'cylinders' => 6, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['Supra']?->id, 'name' => '2.0L Turbo', 'code' => 'B48', 'displacement' => 2.0, 'horsepower' => 255, 'kw' => 190, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['GR86']?->id, 'name' => '2.4L', 'code' => 'FA24', 'displacement' => 2.4, 'horsepower' => 228, 'kw' => 170, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2021],
            ['car_model_id' => $models['GR Yaris']?->id, 'name' => '1.6L Turbo', 'code' => 'G16E-GTS', 'displacement' => 1.6, 'horsepower' => 261, 'kw' => 195, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Турбо', 'year_from' => 2020],
            ['car_model_id' => $models['GR Corolla']?->id, 'name' => '1.6L Turbo', 'code' => 'G16E-GTS', 'displacement' => 1.6, 'horsepower' => 300, 'kw' => 224, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Турбо', 'year_from' => 2022],

            // ==================== Электромоторы ====================
            ['car_model_id' => $models['bZ4X']?->id, 'name' => 'Electric', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 201, 'kw' => 150, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2022],
            ['car_model_id' => $models['bZ4X']?->id, 'name' => 'Electric AWD', 'code' => 'EV', 'displacement' => 0.0, 'horsepower' => 214, 'kw' => 160, 'fuel_type' => 'Электро', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2022],
            ['car_model_id' => $models['Mirai']?->id, 'name' => 'Hydrogen Fuel Cell', 'code' => 'FC', 'displacement' => 0.0, 'horsepower' => 182, 'kw' => 136, 'fuel_type' => 'Водород', 'cylinders' => 0, 'turbo' => 'Атмосферный', 'year_from' => 2020],

            // ==================== Малолитражные двигатели (Yaris, Aygo) ====================
            ['car_model_id' => $models['Yaris']?->id, 'name' => '1.0L', 'code' => '1KR-FE', 'displacement' => 1.0, 'horsepower' => 68, 'kw' => 51, 'fuel_type' => 'Бензин', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2005],
            ['car_model_id' => $models['Yaris']?->id, 'name' => '1.3L', 'code' => '2NZ-FE', 'displacement' => 1.3, 'horsepower' => 87, 'kw' => 65, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2005],
            ['car_model_id' => $models['Yaris']?->id, 'name' => '1.5L', 'code' => '1NZ-FE', 'displacement' => 1.5, 'horsepower' => 105, 'kw' => 78, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 1999, 'year_to' => 2005],
            ['car_model_id' => $models['Yaris']?->id, 'name' => '1.5L', 'code' => '2NR-FE', 'displacement' => 1.5, 'horsepower' => 107, 'kw' => 80, 'fuel_type' => 'Бензин', 'cylinders' => 4, 'turbo' => 'Атмосферный', 'year_from' => 2013],
            ['car_model_id' => $models['Yaris']?->id, 'name' => '1.5L Hybrid', 'code' => 'M15A-FXE', 'displacement' => 1.5, 'horsepower' => 114, 'kw' => 85, 'fuel_type' => 'Гибрид', 'cylinders' => 3, 'turbo' => 'Атмосферный', 'year_from' => 2020],
        ];

        foreach ($engines as $engine) {
            if ($engine['car_model_id']) {
                Engine::updateOrCreate(
                    ['car_model_id' => $engine['car_model_id'], 'code' => $engine['code']],
                    $engine
                );
            }
        }

        $this->command->info('✓ Toyota engines seeded: ' . count($engines));
    }
}
