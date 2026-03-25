<?php

namespace Database\Seeders\Cars;

use Illuminate\Database\Seeder;
use App\Models\CarMake;
use App\Models\CarModel;

class MercedesBenzSeeder extends Seeder
{
    public function run(): void
    {
        $make = CarMake::where('name', 'Mercedes-Benz')->first();

        if (!$make) {
            $this->command->error('Mercedes-Benz not found! Run CarMakeSeeder first.');
            return;
        }

        $models = [
            // A-Class
            'A 180', 'A 200', 'A 220', 'A 250', 'A 35 AMG', 'A 45 AMG',

            // B-Class
            'B 180', 'B 200', 'B 250', 'B 35 AMG',

            // C-Class
            'C 180', 'C 200', 'C 220', 'C 250', 'C 300', 'C 350',
            'C 43 AMG', 'C 63 AMG', 'C 63 S AMG',

            // E-Class
            'E 200', 'E 220', 'E 250', 'E 300', 'E 350', 'E 400', 'E 450',
            'E 53 AMG', 'E 63 AMG', 'E 63 S AMG',

            // S-Class
            'S 320', 'S 350', 'S 400', 'S 450', 'S 500', 'S 560', 'S 580',
            'S 63 AMG', 'S 65 AMG', 'S 600', 'S 680 Maybach',

            // CLA-Class
            'CLA 200', 'CLA 250', 'CLA 35 AMG', 'CLA 45 AMG',

            // CLS-Class
            'CLS 350', 'CLS 400', 'CLS 450', 'CLS 500', 'CLS 53 AMG', 'CLS 63 AMG',

            // GLA-Class
            'GLA 200', 'GLA 250', 'GLA 35 AMG', 'GLA 45 AMG',

            // GLB-Class
            'GLB 200', 'GLB 250', 'GLB 35 AMG',

            // GLC-Class
            'GLC 200', 'GLC 250', 'GLC 300', 'GLC 350', 'GLC 43 AMG', 'GLC 63 AMG',

            // GLE-Class
            'GLE 300', 'GLE 350', 'GLE 400', 'GLE 450', 'GLE 53 AMG', 'GLE 63 AMG',

            // GLS-Class
            'GLS 400', 'GLS 450', 'GLS 500', 'GLS 580', 'GLS 600 Maybach',

            // G-Class
            'G 350', 'G 400', 'G 500', 'G 550', 'G 63 AMG', 'G 65 AMG', 'G 350 d',

            // ML-Class
            'ML 250', 'ML 320', 'ML 350', 'ML 400', 'ML 500', 'ML 63 AMG',

            // GLK-Class
            'GLK 200', 'GLK 220', 'GLK 250', 'GLK 300', 'GLK 350',

            // EQ Series (Electric)
            'EQA 250', 'EQB 250', 'EQB 300', 'EQB 350', 'EQC 400',
            'EQE 300', 'EQE 350', 'EQE 500', 'EQE 53 AMG',
            'EQS 450', 'EQS 580', 'EQS 680 Maybach', 'EQS 53 AMG',
            'EQV 300', 'EQV 350',

            // AMG GT
            'AMG GT', 'AMG GT 43', 'AMG GT 53', 'AMG GT 63', 'AMG GT 63 S', 'AMG GT R',
            'AMG GT Black Series',

            // V-Class
            'V 220', 'V 250', 'V 300', 'V 350',

            // Commercial
            'Sprinter', 'Vito', 'Citan', 'X-Class', 'Metris'
        ];

        foreach ($models as $modelName) {
            CarModel::firstOrCreate([
                'car_make_id' => $make->id,
                'name' => $modelName,
            ]);
        }

        $this->command->info('✓ Mercedes-Benz models seeded: ' . count($models));
    }
}
