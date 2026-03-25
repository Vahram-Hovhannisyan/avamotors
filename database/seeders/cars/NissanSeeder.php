<?php

namespace Database\Seeders\Cars;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;

class NissanSeeder extends Seeder
{
    public function run(): void
    {
        $make = CarMake::where('name', 'Nissan')->first();

        if (!$make) {
            $this->command->error('Nissan not found! Run CarMakeSeeder first.');
            return;
        }

        $models = [
            // Sedans
            'Ariya', 'Almera', 'Sunny', 'Pulsar', 'Sentra', 'Altima', 'Maxima', 'Teana',
            'Skyline', 'Cefiro', 'Laurel', 'Gloria', 'Cedric', 'President',
            'Bluebird', 'Wingroad', 'Latio', 'Sylphy', 'Tiida', 'Versa',

            // SUVs & Crossovers
            'Qashqai', 'Rogue', 'X-Trail', 'Murano', 'Pathfinder', 'Armada',
            'Juke', 'Kicks', 'Ariya', 'Terra', 'X-Terra', 'Rogue Sport',
            'Patrol', 'Patrol Safari', 'Terrano', 'Mistral', 'Rasheen',

            // Pickups & Trucks
            'Navara', 'Frontier', 'Titan', 'Hardbody', 'Datsun', 'NP300',

            // Vans & Minivans
            'Elgrand', 'Quest', 'NV200', 'NV350', 'Caravan', 'Homy', 'Serena',
            'Lafesta', 'Prairie', 'Liberty', 'Presage',

            // Hatchbacks
            'Note', 'Micra', 'March', 'Cube', 'Pixo', 'Leaf',

            // Sports Cars
            'GT-R', 'Fairlady Z', '370Z', '350Z', '300ZX', '240Z', 'Silvia',
            '180SX', '200SX', '240SX', 'Pulsar GTI-R',

            // Electric
            'Leaf', 'Ariya', 'Sakura',

            // Commercial
            'Atlas', 'Cabstar', 'NT400', 'NT500', 'Cima'
        ];

        foreach ($models as $modelName) {
            CarModel::firstOrCreate([
                'car_make_id' => $make->id,
                'name' => $modelName,
            ]);
        }

        $this->command->info('✓ Nissan models seeded: ' . count($models));
    }
}
