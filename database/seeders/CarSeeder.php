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
                'Wish', 'Isis', 'Premio', 'Allion', 'Celica', 'Prius',
                'Avalon', 'Sienna', 'Alphard', 'Supra', 'Sequoia', 'Tundra',
                '4Runner', 'Tacoma', 'Kluger', 'Estima', 'Previa', 'Matrix',
                'Vitz', 'Aygo', 'Altezza', 'MR2', 'GT86', 'GR86', 'Crown',
                'Century', 'Mirai', 'bZ4X', 'Corolla Cross', 'Yaris Cross'
            ],
            'Lexus' => [
                'IS 200', 'IS 250', 'IS 300', 'IS 350', 'IS 500',
                'ES 250', 'ES 300', 'ES 350', 'ES 300h',
                'RX 300', 'RX 330', 'RX 350', 'RX 350h', 'RX 450h', 'RX 500h',
                'GX 460', 'GX 470', 'GX 550',
                'LX 470', 'LX 570', 'LX 600', 'LX 700h',
                'LS 400', 'LS 430', 'LS 460', 'LS 500', 'LS 500h', 'LS 600h',
                'GS 300', 'GS 350', 'GS 400', 'GS 430', 'GS 450h', 'GS F',
                'ES 330', 'SC 300', 'SC 400', 'SC 430',
                'NX 200t', 'NX 300', 'NX 300h', 'NX 350', 'NX 350h', 'NX 450h+',
                'UX 200', 'UX 250h', 'UX 300e',
                'RC 200t', 'RC 300', 'RC 350', 'RC F',
                'LC 500', 'LC 500h',
                'LFA', 'RZ 450e', 'TX 350', 'TX 500h', 'TX 550h+'
            ],
            'Mercedes-Benz' => [
                'A 180', 'A 200', 'A 220', 'A 250', 'A 35 AMG', 'A 45 AMG',
                'B 180', 'B 200', 'B 250',
                'C 180', 'C 200', 'C 220', 'C 250', 'C 300', 'C 350', 'C 43 AMG', 'C 63 AMG',
                'E 200', 'E 220', 'E 250', 'E 300', 'E 350', 'E 400', 'E 450', 'E 53 AMG', 'E 63 AMG',
                'S 320', 'S 350', 'S 400', 'S 450', 'S 500', 'S 560', 'S 580', 'S 65 AMG',
                'GLA 200', 'GLA 250', 'GLA 35 AMG', 'GLA 45 AMG',
                'GLB 200', 'GLB 250', 'GLB 35 AMG',
                'GLC 200', 'GLC 250', 'GLC 300', 'GLC 350', 'GLC 43 AMG', 'GLC 63 AMG',
                'GLE 300', 'GLE 350', 'GLE 400', 'GLE 450', 'GLE 53 AMG', 'GLE 63 AMG',
                'GLS 400', 'GLS 450', 'GLS 500', 'GLS 580', 'GLS 600 Maybach',
                'G 350', 'G 400', 'G 500', 'G 550', 'G 63 AMG', 'G 65 AMG',
                'ML 250', 'ML 320', 'ML 350', 'ML 400', 'ML 500', 'ML 63 AMG',
                'GLK 200', 'GLK 220', 'GLK 250', 'GLK 300', 'GLK 350',
                'EQE 300', 'EQE 350', 'EQE 500', 'EQE 53 AMG',
                'EQS 450', 'EQS 580', 'EQS 680 Maybach',
                'V 220', 'V 250', 'V 300', 'Sprinter', 'Vito'
            ],
            'BMW' => [
                '114i', '116i', '118i', '120i', '125i', '128i', '130i', '135i',
                '316i', '318i', '320i', '323i', '325i', '328i', '330i', '335i', '340i', 'M340i',
                '520i', '523i', '525i', '528i', '530i', '535i', '540i', '545i', '550i', 'M550i',
                '730i', '735i', '740i', '745i', '750i', '760i', 'M760i',
                'X1', 'X2', 'X3', 'X4', 'X5', 'X6', 'X7', 'XM',
                'Z3', 'Z4', 'Z8',
                'M2', 'M3', 'M4', 'M5', 'M6', 'M8',
                'i3', 'i4', 'i5', 'i7', 'i8', 'iX', 'iX1', 'iX3'
            ],
            'Audi' => [
                'A1', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8',
                'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9',
                'TT', 'R8',
                'RS3', 'RS4', 'RS5', 'RS6', 'RS7', 'RS Q8',
                'S3', 'S4', 'S5', 'S6', 'S7', 'S8',
                'e-tron', 'e-tron GT', 'Q4 e-tron', 'Q6 e-tron', 'Q8 e-tron'
            ],
            'Volkswagen' => [
                'Golf', 'Golf GTI', 'Golf R', 'Passat', 'Passat CC', 'Arteon',
                'Tiguan', 'Tiguan Allspace', 'Touareg', 'T-Roc', 'Taos', 'Atlas',
                'Polo', 'Jetta', 'Vento', 'Virtus',
                'Phaeton', 'Caddy', 'Transporter', 'Multivan', 'California',
                'ID.3', 'ID.4', 'ID.5', 'ID.6', 'ID.7', 'ID. Buzz',
                'Amarok', 'Saveiro', 'Fox', 'Up!'
            ],
            'Honda' => [
                'Civic', 'Civic Type R', 'Accord', 'CR-V', 'HR-V', 'ZR-V', 'Pilot',
                'Jazz', 'Fit', 'City', 'Amaze', 'Brio',
                'Odyssey', 'Stepwgn', 'Freed', 'Elysion',
                'Ridgeline', 'Passport', 'Prologue',
                'NSX', 'S2000', 'Integra', 'Prelude',
                'e', 'e:Ny1', 'CR-Z', 'Insight', 'Clarity'
            ],
            'Nissan' => [
                'Almera', 'Sunny', 'Pulsar', 'Sentra', 'Altima', 'Maxima', 'Teana',
                'Qashqai', 'Juke', 'Murano', 'Rogue', 'X-Trail', 'X-Terra',
                'Pathfinder', 'Patrol', 'Armada', 'Navara', 'Frontier', 'Titan',
                'Note', 'Micra', 'Leaf', 'Ariya',
                'GT-R', 'Skyline', 'Fairlady Z', '370Z', '350Z', '240Z',
                'Cube', 'Elgrand', 'Quest', 'NV200', 'NV350',
                'Terrano', 'Bluebird', 'Cefiro', 'Laurel', 'Gloria'
            ],
            'Infiniti' => [
                'G20', 'G25', 'G35', 'G37', 'Q40', 'Q50', 'Q60',
                'I30', 'I35',
                'M35', 'M37', 'M45', 'M56', 'Q70',
                'FX35', 'FX37', 'FX45', 'FX50', 'QX70',
                'EX35', 'EX37', 'QX50',
                'JX35', 'QX60',
                'QX4', 'QX56', 'QX80',
                'Q30', 'QX30',
                'Q45', 'Q45t'
            ],
            'Hyundai' => [
                'Accent', 'Solaris', 'Elantra', 'Avante', 'Sonata', 'Azera', 'Grandeur',
                'Tucson', 'ix35', 'Santa Fe', 'Palisade', 'Veracruz', 'Nexo',
                'Creta', 'Kona', 'Venue', 'Bayon', 'Staria',
                'i10', 'i20', 'i30', 'i40', 'i45',
                'Genesis', 'Equus', 'Centennial',
                'IONIQ 5', 'IONIQ 6', 'IONIQ 9', 'Kona Electric', 'Santa Fe Hybrid'
            ],
            'Kia' => [
                'Picanto', 'Morning', 'Ray',
                'Rio', 'K2', 'K3', 'Forte', 'Cerato',
                'Ceed', 'ProCeed', 'K4', 'K5', 'Optima', 'K7', 'Cadenza', 'K8', 'K9',
                'Sportage', 'Seltos', 'Niro', 'Sorento', 'Mohave', 'Telluride', 'Carnival',
                'Soul', 'Stinger', 'Stonic', 'Soul EV',
                'EV3', 'EV5', 'EV6', 'EV9', 'EV4'
            ],
            'Mazda' => [
                'Mazda 2', 'Mazda 3', 'Mazda 5', 'Mazda 6',
                'CX-3', 'CX-5', 'CX-7', 'CX-8', 'CX-9', 'CX-30', 'CX-50', 'CX-60', 'CX-70', 'CX-80', 'CX-90',
                'MX-5', 'MX-30', 'RX-7', 'RX-8',
                'BT-50', 'MPV', 'Premacy', 'Biante', 'Bongo'
            ],
            'Mitsubishi' => [
                'Lancer', 'Lancer Evolution', 'Galant', 'Legnum',
                'Outlander', 'Outlander Sport', 'ASX', 'Eclipse Cross', 'RVR',
                'Pajero', 'Pajero Sport', 'Montero', 'Shogun',
                'Delica', 'Space Gear', 'Grandis',
                'Mirage', 'Colt', 'Attrage',
                'i-MiEV', 'eK', 'Minicab', 'Triton', 'L200'
            ],
            'Subaru' => [
                'Impreza', 'WRX', 'WRX STI', 'Legacy', 'Liberty', 'Outback',
                'Forester', 'Crosstrek', 'XV', 'Solterra',
                'BRZ', 'SVX', 'Alcyone',
                'Ascent', 'Tribeca', 'Exiga', 'Levorg',
                'Justy', 'Pleo', 'R1', 'R2', 'Sambar'
            ],
            'Chevrolet' => [
                'Spark', 'Beat', 'Sail', 'Aveo', 'Sonic', 'Cruze', 'Cobalt',
                'Malibu', 'Impala', 'Camaro', 'Corvette',
                'Captiva', 'Equinox', 'Traverse', 'Trailblazer', 'Blazer', 'Tahoe', 'Suburban',
                'Colorado', 'Silverado', 'S10', 'Montana',
                'Orlando', 'Spin', 'Nexia', 'Lacetti', 'Epica'
            ],
            'Opel' => [
                'Adam', 'Corsa', 'Astra', 'Insignia', 'Vectra', 'Omega',
                'Mokka', 'Crossland', 'Grandland', 'Antara', 'Frontera',
                'Zafira', 'Meriva', 'Combo', 'Vivaro', 'Movano',
                'Karl', 'Agila', 'Tigra', 'GT', 'Speedster'
            ],
            'Peugeot' => [
                '106', '107', '108', '206', '207', '208', '301', '306', '307', '308', '309',
                '406', '407', '408', '508', '607',
                '2008', '3008', '4007', '4008', '5008',
                'Partner', 'Rifter', 'Traveller', 'Boxer',
                'RCZ', 'iOn', 'e-208', 'e-2008', 'e-3008', 'e-5008'
            ],
            'Renault' => [
                'Logan', 'Sandero', 'Stepway', 'Duster', 'Capture', 'Kaptur', 'Arkana',
                'Megane', 'Fluence', 'Laguna', 'Latitude', 'Talisman',
                'Clio', 'Twingo', 'Zoe', 'Scenic', 'Espace', 'Kangoo', 'Trafic', 'Master',
                'Koleos', 'Austral', 'Rafale', 'Symbioz'
            ],
            'Skoda' => [
                'Fabia', 'Rapid', 'Scala', 'Octavia', 'Superb',
                'Kamiq', 'Karoq', 'Kodiaq', 'Enyaq', 'Yeti',
                'Citigo', 'Roomster', 'Felicia', 'Favorit'
            ],
            'Volvo' => [
                'S40', 'S60', 'S70', 'S80', 'S90',
                'V40', 'V50', 'V60', 'V70', 'V90',
                'XC40', 'XC60', 'XC70', 'XC90',
                'C30', 'C70',
                'EX30', 'EX90', 'EC40', 'EM90',
                '850', '940', '960', '240', '740', '760'
            ],
            'Suzuki' => [
                'Swift', 'Ignis', 'Baleno', 'Celerio', 'Splash',
                'SX4', 'S-Cross', 'Vitara', 'Grand Vitara', 'Jimny',
                'Alto', 'Wagon R', 'Spacia', 'Hustler',
                'Ertiga', 'XL6', 'APV', 'Carry', 'Every',
                'Kizashi', 'Across', 'Swace', 'eVitara'
            ],
            'Jeep' => [
                'Wrangler', 'Wrangler Unlimited', 'Gladiator',
                'Grand Cherokee', 'Cherokee', 'Compass', 'Renegade', 'Patriot',
                'Commander', 'Wagoneer', 'Grand Wagoneer',
                'CJ', 'CJ-5', 'CJ-7', 'Scrambler'
            ],
            'Land Rover' => [
                'Defender', 'Defender 90', 'Defender 110', 'Defender 130',
                'Discovery', 'Discovery Sport', 'Range Rover', 'Range Rover Sport',
                'Range Rover Velar', 'Range Rover Evoque', 'Freelander', 'Series'
            ],
            'Porsche' => [
                '911', '911 Carrera', '911 Turbo', '911 GT3', '911 GT2',
                'Boxster', 'Cayman', 'Panamera', 'Taycan', 'Macan', 'Cayenne',
                '918 Spyder', 'Carrera GT'
            ],
            'Chrysler' => [
                '300', '300C', 'Pacifica', 'Voyager', 'Town & Country',
                'Sebring', 'PT Cruiser', 'Crossfire'
            ],
            'Dodge' => [
                'Charger', 'Challenger', 'Durango', 'Journey', 'Grand Caravan',
                'Viper', 'Neon', 'Caliber', 'Avenger', 'Dart'
            ],
            'Tesla' => [
                'Model 3', 'Model S', 'Model X', 'Model Y', 'Cybertruck', 'Roadster'
            ],
            'BYD' => [
                'Atto 3', 'Seal', 'Dolphin', 'Han', 'Tang', 'Song',
                'e6', 'e2', 'Yuan Plus', 'Seagull'
            ],
            'GAC' => [
                'GS3', 'GS4', 'GS8', 'GN6', 'GN8', 'Emkoo', 'Aion S', 'Aion Y', 'Aion V'
            ],
            'Dongfeng' => [
                'AX7', 'S30', 'H30', 'A9', '580', 'ix5', 'ix7', 'Nammi 01', 'Box'
            ],
            'Citroën' => [
                'C1', 'C2', 'C3', 'C3 Aircross', 'C4', 'C4 Cactus', 'C4 Picasso', 'C5', 'C5 Aircross', 'C6',
                'Berlingo', 'Jumpy', 'Jumper', 'DS3', 'DS4', 'DS5', 'DS7', 'DS9'
            ],
            'Fiat' => [
                '500', '500X', '500L', 'Panda', 'Tipo', 'Doblo', 'Ducato',
                'Bravo', 'Punto', 'Grande Punto', 'Linea', 'Palio', 'Siena', 'Uno'
            ],
            'Alfa Romeo' => [
                'Giulia', 'Stelvio', 'Tonale', 'Junior',
                '147', '156', '159', '166', 'Brera', 'Spider', 'MiTo', '4C', '8C'
            ],
            'Mini' => [
                'Cooper', 'Cooper S', 'John Cooper Works', 'One',
                'Clubman', 'Countryman', 'Paceman', 'Coupe', 'Roadster'
            ],
            'Seat' => [
                'Ibiza', 'Leon', 'Ateca', 'Arona', 'Tarraco', 'Alhambra', 'Mii', 'Toledo', 'Exeo'
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
