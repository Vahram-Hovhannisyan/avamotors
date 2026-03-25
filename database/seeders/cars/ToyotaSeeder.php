<?php

namespace Database\Seeders\Cars;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;

class ToyotaSeeder extends Seeder
{
    public function run(): void
    {
        $make = CarMake::where('name', 'Toyota')->first();

        if (!$make) {
            $this->command->error('Toyota not found! Run CarMakeSeeder first.');
            return;
        }

        $models = [
            // Sedans
            'Camry', 'Corolla', 'Avalon', 'Yaris', 'Prius', 'Mirai',
            'Crown', 'Century', 'Premio', 'Allion', 'Belta', 'Vios',
            'Etios', 'Platz', 'Tercel', 'Starlet', 'Cressida',

            // SUVs & Crossovers
            'RAV4', 'Highlander', 'Land Cruiser', 'Land Cruiser Prado', 'Land Cruiser 70',
            'Sequoia', '4Runner', 'FJ Cruiser', 'Fortuner', 'C-HR', 'Venza',
            'Harrier', 'Kluger', 'Rush', 'Urban Cruiser', 'Corolla Cross',
            'Yaris Cross', 'Raize', 'Rav4', 'Kluger',

            // Pickups & Trucks
            'Hilux', 'Tacoma', 'Tundra', 'T100',

            // Vans & Minivans
            'Sienna', 'Alphard', 'Vellfire', 'Estima', 'Previa', 'Noah', 'Voxy',
            'Esquire', 'Hiace', 'Granvia', 'TownAce', 'LiteAce',

            // Hatchbacks
            'Auris', 'Corolla Hatchback', 'Yaris Hatchback', 'Prius C', 'Prius V',
            'Aqua', 'Vitz', 'Ist', 'Ractis', 'Porte', 'Spade',

            // Sports Cars
            'Supra', 'GR Supra', 'GR86', 'GT86', 'MR2', 'Celica', 'GR Corolla',
            'GR Yaris', '86', 'Sports 800', '2000GT',

            // Electric & Hybrid
            'bZ4X', 'Prius Prime', 'Mirai', 'RAV4 Hybrid', 'Camry Hybrid',
            'Highlander Hybrid', 'Corolla Hybrid', 'Yaris Hybrid',

            // Commercial
            'Dyna', 'Toyota 200', 'Coaster', 'Quantum', 'Hiace', 'Dyna'
        ];

        foreach ($models as $modelName) {
            CarModel::firstOrCreate([
                'car_make_id' => $make->id,
                'name' => $modelName,
            ]);
        }

        $this->command->info('✓ Toyota models seeded: ' . count($models));
    }
}
