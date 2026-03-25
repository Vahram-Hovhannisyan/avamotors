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
            CarSeeder::class
        ]);

        $this->command->info('✓ All seeders completed!');
    }
}
