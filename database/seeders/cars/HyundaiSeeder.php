<?php

namespace Database\Seeders\Cars;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;

class HyundaiSeeder extends Seeder
{
    public function run(): void
    {
        $make = CarMake::where('name', 'Hyundai')->first();

        if (!$make) {
            $this->command->error('Hyundai not found! Run CarMakeSeeder first.');
            return;
        }

        $models = [
            // Sedans
            'Accent', 'Solaris', 'Elantra', 'Avante', 'Sonata', 'Azera', 'Grandeur',
            'XG', 'Dynasty', 'Equus', 'Centennial', 'Genesis', 'i40', 'i45',

            // SUVs & Crossovers
            'Tucson', 'ix35', 'Santa Fe', 'Palisade', 'Veracruz', 'Nexo',
            'Creta', 'Kona', 'Venue', 'Bayon', 'Staria', 'Alcazar',

            // Hatchbacks
            'i10', 'i20', 'i30', 'Getz', 'Click', 'HB20', 'Veloster',

            // Coupes
            'Genesis Coupe', 'Tiburon', 'Coupe', 'Scoupe',

            // Electric & Hybrid
            'IONIQ 5', 'IONIQ 6', 'IONIQ 9', 'Kona Electric', 'Santa Fe Hybrid',
            'IONIQ', 'IONIQ Plug-in', 'IONIQ Electric',

            // Vans
            'Starex', 'H-1', 'H350', 'iLoad', 'iMax', 'Grace', 'Porter',

            // Commercial
            'Mighty', 'HD65', 'HD72', 'HD78', 'Pavise', 'County'
        ];

        foreach ($models as $modelName) {
            CarModel::firstOrCreate([
                'car_make_id' => $make->id,
                'name' => $modelName,
            ]);
        }

        $this->command->info('✓ Hyundai models seeded: ' . count($models));
    }
}
