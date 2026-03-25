<?php

namespace Database\Seeders\Cars;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;

class LexusSeeder extends Seeder
{
    public function run(): void
    {
        $make = CarMake::where('name', 'Lexus')->first();

        if (!$make) {
            $this->command->error('Lexus not found! Run CarMakeSeeder first.');
            return;
        }

        $models = [
            // Sedans
            'IS 200', 'IS 250', 'IS 300', 'IS 350', 'IS 500',
            'ES 250', 'ES 300', 'ES 330', 'ES 350', 'ES 300h',
            'LS 400', 'LS 430', 'LS 460', 'LS 500', 'LS 500h', 'LS 600h',
            'GS 300', 'GS 350', 'GS 400', 'GS 430', 'GS 450h', 'GS F',

            // SUVs & Crossovers
            'RX 300', 'RX 330', 'RX 350', 'RX 350h', 'RX 450h', 'RX 500h',
            'NX 200t', 'NX 300', 'NX 300h', 'NX 350', 'NX 350h', 'NX 450h+',
            'UX 200', 'UX 250h', 'UX 300e',
            'GX 460', 'GX 470', 'GX 550',
            'LX 470', 'LX 570', 'LX 600', 'LX 700h',
            'TX 350', 'TX 500h', 'TX 550h+',
            'RZ 450e',

            // Coupes & Convertibles
            'RC 200t', 'RC 300', 'RC 350', 'RC F',
            'LC 500', 'LC 500h',
            'SC 300', 'SC 400', 'SC 430',

            // Performance
            'LFA',

            // Crossovers
            'Q30', 'QX30',

            // Electric
            'RZ 450e', 'UX 300e'
        ];

        foreach ($models as $modelName) {
            CarModel::firstOrCreate([
                'car_make_id' => $make->id,
                'name' => $modelName,
            ]);
        }

        $this->command->info('✓ Lexus models seeded: ' . count($models));
    }
}
