<?php

namespace Database\Seeders;

use App\Models\CarMake;
use App\Models\CarModel;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Toyota' => [
                'Camry', 'Corolla', 'RAV4', 'Land Cruiser', 'Land Cruiser Prado',
                'Highlander', 'Yaris', 'Auris', 'Avensis', 'Hilux',
                'FJ Cruiser', 'Fortuner', 'Rush', 'C-HR', 'Venza',
            ],
            'Lexus' => [
                'IS 200', 'IS 250', 'IS 300', 'ES 250', 'ES 300', 'ES 350',
                'RX 300', 'RX 330', 'RX 350', 'GX 460', 'LX 470', 'LX 570',
                'LS 400', 'LS 430', 'GS 300',
            ],
            'Mercedes-Benz' => [
                'C 180', 'C 200', 'C 220', 'C 250', 'C 300',
                'E 200', 'E 220', 'E 250', 'E 300', 'E 350',
                'S 320', 'S 350', 'S 500', 'GLC 200', 'GLC 300',
                'ML 250', 'ML 320', 'ML 350', 'GLK 250', 'GLK 300',
            ],
            'BMW' => [
                '316i', '318i', '320i', '325i', '330i',
                '520i', '523i', '525i', '528i', '530i',
                '730i', '735i', '740i', 'X3', 'X5', 'X6',
                'M3', 'M5',
            ],
            'Audi' => [
                'A3', 'A4', 'A5', 'A6', 'A7', 'A8',
                'Q3', 'Q5', 'Q7', 'Q8',
                'TT', 'RS4', 'RS6',
            ],
            'Volkswagen' => [
                'Golf', 'Passat', 'Tiguan', 'Touareg', 'Polo',
                'Jetta', 'Phaeton', 'Caddy', 'Transporter',
            ],
            'Honda' => [
                'Civic', 'Accord', 'CR-V', 'HR-V', 'Pilot',
                'Jazz', 'Fit', 'Odyssey', 'Ridgeline',
            ],
            'Nissan' => [
                'Almera', 'Altima', 'Maxima', 'Pathfinder', 'X-Trail',
                'Qashqai', 'Juke', 'Murano', 'Patrol', 'Navara',
                'Note', 'Tiida', 'Teana',
            ],
            'Hyundai' => [
                'Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'ix35',
                'Accent', 'i30', 'Creta', 'Palisade', 'Kona',
            ],
            'Kia' => [
                'Rio', 'Ceed', 'Sportage', 'Sorento', 'Stinger',
                'Optima', 'Carnival', 'Telluride', 'Seltos',
            ],
            'Mazda' => [
                'Mazda 3', 'Mazda 6', 'CX-5', 'CX-7', 'CX-9',
                'MX-5', 'RX-8', '626', 'MPV',
            ],
            'Mitsubishi' => [
                'Lancer', 'Outlander', 'Pajero', 'Pajero Sport',
                'Eclipse Cross', 'ASX', 'Galant', 'Carisma',
            ],
            'Subaru' => [
                'Impreza', 'Legacy', 'Outback', 'Forester',
                'XV', 'WRX', 'BRZ', 'Tribeca',
            ],
            'Chevrolet' => [
                'Cruze', 'Malibu', 'Captiva', 'Equinox', 'Tahoe',
                'Suburban', 'Spark', 'Aveo', 'Trailblazer',
            ],
            'Opel' => [
                'Astra', 'Vectra', 'Corsa', 'Insignia', 'Mokka',
                'Antara', 'Zafira', 'Meriva',
            ],
            'Peugeot' => [
                '206', '207', '208', '301', '307', '308',
                '407', '408', '508', '2008', '3008', '5008',
            ],
            'Renault' => [
                'Logan', 'Sandero', 'Duster', 'Megane', 'Laguna',
                'Fluence', 'Captur', 'Koleos', 'Scenic',
            ],
            'Skoda' => [
                'Octavia', 'Superb', 'Fabia', 'Rapid', 'Kodiaq',
                'Karoq', 'Yeti',
            ],
            'Volvo' => [
                'S40', 'S60', 'S80', 'V40', 'V60', 'V70',
                'XC40', 'XC60', 'XC90',
            ],
        ];

        foreach ($data as $makeName => $models) {
            $make = CarMake::firstOrCreate(['name' => $makeName]);

            foreach ($models as $modelName) {
                CarModel::firstOrCreate([
                    'car_make_id' => $make->id,
                    'name'        => $modelName,
                ]);
            }
        }

        $this->command->info('✓ Car makes and models seeded: ' . count($data) . ' makes');
    }
}
