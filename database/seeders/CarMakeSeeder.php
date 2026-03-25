<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarMake;

class CarMakeSeeder extends Seeder
{
    public function run(): void
    {
        $makes = [
            ['name' => 'Toyota'],
            ['name' => 'Lexus'],
            ['name' => 'Nissan'],
            ['name' => 'Hyundai'],
            ['name' => 'Kia'],
            ['name' => 'Mercedes-Benz'],
            ['name' => 'BMW'],
        ];

        foreach ($makes as $make) {
            CarMake::firstOrCreate(
                ['name' => $make['name']],
                $make
            );
        }

        $this->command->info('✓ Car makes seeded: ' . count($makes));
    }
}
