<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Базовые сидеры
            UserSeeder::class,
            CategorySeeder::class,
            CarMakeSeeder::class,

            // Сидеры моделей по маркам
            \Database\Seeders\cars\ToyotaSeeder::class,
            \Database\Seeders\cars\LexusSeeder::class,
            \Database\Seeders\cars\NissanSeeder::class,
            \Database\Seeders\cars\HyundaiSeeder::class,
            \Database\Seeders\cars\KiaSeeder::class,
            \Database\Seeders\cars\MercedesBenzSeeder::class,

            // Сидеры двигателей по маркам
            \Database\Seeders\engines\ToyotaEngineSeeder::class,
            \Database\Seeders\engines\LexusEngineSeeder::class,
            \Database\Seeders\engines\NissanEngineSeeder::class,
            \Database\Seeders\engines\HyundaiEngineSeeder::class,
            \Database\Seeders\engines\KiaEngineSeeder::class,
            \Database\Seeders\engines\MercedesBenzEngineSeeder::class,
        ]);

        $this->command->info('✓ All seeders completed!');
    }
}
