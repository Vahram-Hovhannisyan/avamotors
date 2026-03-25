<?php

namespace Database\Seeders\Cars;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;

class KiaSeeder extends Seeder
{
    public function run(): void
    {
        $make = CarMake::where('name', 'Kia')->first();

        if (!$make) {
            $this->command->error('Kia not found! Run CarMakeSeeder first.');
            return;
        }

        $models = [
            // Sedans
            'Rio', 'K2', 'K3', 'Forte', 'Cerato', 'K4', 'K5', 'Optima',
            'K7', 'Cadenza', 'K8', 'K9', 'Magentis', 'Clarus', 'Sephia', 'Shuma',

            // SUVs & Crossovers
            'Sportage', 'Seltos', 'Niro', 'Sorento', 'Mohave', 'Telluride',
            'Stonic', 'Soul', 'Soul EV', 'EV3', 'EV5', 'EV6', 'EV9', 'EV4',

            // Hatchbacks
            'Picanto', 'Morning', 'Ray', 'Ceed', 'ProCeed', 'Venga', 'Carens',

            // Vans
            'Carnival', 'Sedona', 'Carens', 'Joice', 'BestA', 'Pregio',

            // Electric
            'EV6', 'EV9', 'EV3', 'EV5', 'EV4', 'Niro EV', 'Soul EV',

            // Commercial
            'Bongo', 'K2500', 'K2700', 'K3000', 'Travello'
        ];

        foreach ($models as $modelName) {
            CarModel::firstOrCreate([
                'car_make_id' => $make->id,
                'name' => $modelName,
            ]);
        }

        $this->command->info('✓ Kia models seeded: ' . count($models));
    }
}
