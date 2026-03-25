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
                // Sedans
                'Camry', 'Corolla', 'Avalon', 'Yaris', 'Prius', 'Mirai', 'Crown', 'Century',
                'Premio', 'Allion', 'Belta', 'Vios', 'Etios', 'Platz', 'Tercel', 'Starlet', 'Cressida',
                'Mark X', 'Blade', 'Verossa', 'Chaser', 'Cresta', 'Corona', 'Carina', 'Sprinter',

                // SUVs & Crossovers
                'RAV4', 'Highlander', 'Land Cruiser', 'Land Cruiser Prado', 'Land Cruiser 70',
                'Sequoia', '4Runner', 'FJ Cruiser', 'Fortuner', 'C-HR', 'Venza', 'Harrier', 'Kluger',
                'Rush', 'Urban Cruiser', 'Corolla Cross', 'Yaris Cross', 'Raize', 'RAV4 Hybrid',
                'Land Cruiser 300', 'Land Cruiser 250', 'Land Cruiser 200', 'Land Cruiser 100', 'Land Cruiser 80',

                // Pickups & Trucks
                'Hilux', 'Tacoma', 'Tundra', 'T100', 'Toyota Pickup', 'Stout',

                // Vans & Minivans
                'Sienna', 'Alphard', 'Vellfire', 'Estima', 'Previa', 'Noah', 'Voxy', 'Esquire',
                'Hiace', 'Granvia', 'TownAce', 'LiteAce', 'RegiusAce', 'Mega Cruiser',

                // Hatchbacks
                'Auris', 'Corolla Hatchback', 'Yaris Hatchback', 'Prius C', 'Prius V', 'Aqua',
                'Vitz', 'Ist', 'Ractis', 'Porte', 'Spade', 'Passo', 'bB', 'iQ',

                // Sports Cars
                'Supra', 'GR Supra', 'GR86', 'GT86', 'MR2', 'Celica', 'GR Corolla', 'GR Yaris',
                '86', 'Sports 800', '2000GT', 'MR-S', 'MR2 Spyder',

                // Electric & Hybrid
                'bZ4X', 'Prius Prime', 'Mirai', 'RAV4 Hybrid', 'Camry Hybrid', 'Highlander Hybrid',
                'Corolla Hybrid', 'Yaris Hybrid', 'Sienna Hybrid', 'Crown Hybrid',

                // Commercial
                'Dyna', 'Toyota 200', 'Coaster', 'Quantum', 'Toyota 100', 'Dyna 100', 'ToyoAce'
            ],

            'Lexus' => [
                // Sedans
                'IS 200', 'IS 250', 'IS 300', 'IS 350', 'IS 500', 'IS F',
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
                'LFA'
            ],

            'Nissan' => [
                // Sedans
                'Almera', 'Sunny', 'Pulsar', 'Sentra', 'Altima', 'Maxima', 'Teana',
                'Skyline', 'Cefiro', 'Laurel', 'Gloria', 'Cedric', 'President',
                'Bluebird', 'Wingroad', 'Latio', 'Sylphy', 'Tiida', 'Versa',
                'Cima', 'Fuga', 'Leopard', 'Avenir', 'Primera', 'Stanza',

                // SUVs & Crossovers
                'Qashqai', 'Rogue', 'X-Trail', 'Murano', 'Pathfinder', 'Armada',
                'Juke', 'Kicks', 'Ariya', 'Terra', 'X-Terra', 'Rogue Sport',
                'Patrol', 'Patrol Safari', 'Terrano', 'Mistral', 'Rasheen',
                'Paladin', 'R52', 'R51', 'R50', 'WD21',

                // Pickups & Trucks
                'Navara', 'Frontier', 'Titan', 'Hardbody', 'Datsun', 'NP300',
                'D21', 'D22', 'D40', 'D23', '720', '620', '520',

                // Vans & Minivans
                'Elgrand', 'Quest', 'NV200', 'NV350', 'Caravan', 'Homy', 'Serena',
                'Lafesta', 'Prairie', 'Liberty', 'Presage', 'Largo', 'Vanette',

                // Hatchbacks
                'Note', 'Micra', 'March', 'Cube', 'Pixo', 'Leaf', 'Cherry',
                'Pao', 'Figaro', 'Be-1', 'S-Cargo',

                // Sports Cars
                'GT-R', 'Fairlady Z', '370Z', '350Z', '300ZX', '240Z', '260Z', '280Z',
                'Silvia', '180SX', '200SX', '240SX', 'Pulsar GTI-R', 'Skyline GT-R',

                // Electric
                'Leaf', 'Ariya', 'Sakura',

                // Commercial
                'Atlas', 'Cabstar', 'NT400', 'NT500', 'Condor', 'Junior'
            ],

            'Infiniti' => [
                // Sedans & Coupes
                'G20', 'G25', 'G35', 'G37', 'Q40', 'Q50', 'Q60',
                'I30', 'I35',
                'M35', 'M37', 'M45', 'M56', 'Q70',
                'Q45', 'Q45t',

                // SUVs & Crossovers
                'FX35', 'FX37', 'FX45', 'FX50', 'QX70',
                'EX35', 'EX37', 'QX50',
                'JX35', 'QX60',
                'QX4', 'QX56', 'QX80',
                'Q30', 'QX30'
            ],

            'Hyundai' => [
                // Sedans
                'Accent', 'Solaris', 'Elantra', 'Avante', 'Sonata', 'Azera', 'Grandeur',
                'XG', 'Dynasty', 'Equus', 'Centennial', 'Genesis', 'i40', 'i45',
                'Verna', 'Excel', 'Pony', 'Stellar', 'Marcia', 'Tiburon',

                // SUVs & Crossovers
                'Tucson', 'ix35', 'Santa Fe', 'Palisade', 'Veracruz', 'Nexo',
                'Creta', 'Kona', 'Venue', 'Bayon', 'Staria', 'Alcazar',
                'Galloper', 'Terracan', 'Maxcruz', 'Santa Fe XL',

                // Hatchbacks
                'i10', 'i20', 'i30', 'Getz', 'Click', 'HB20', 'Veloster',
                'i30 N', 'Veloster N',

                // Coupes
                'Genesis Coupe', 'Tiburon', 'Coupe', 'Scoupe',

                // Electric & Hybrid
                'IONIQ 5', 'IONIQ 6', 'IONIQ 9', 'Kona Electric', 'Santa Fe Hybrid',
                'IONIQ', 'IONIQ Plug-in', 'IONIQ Electric', 'IONIQ 5 N',

                // Vans
                'Starex', 'H-1', 'H350', 'iLoad', 'iMax', 'Grace', 'Porter',
                'Libero', 'H100', 'H200',

                // Commercial
                'Mighty', 'HD65', 'HD72', 'HD78', 'Pavise', 'County', 'Universe'
            ],

            'Kia' => [
                // Sedans
                'Rio', 'K2', 'K3', 'Forte', 'Cerato', 'K4', 'K5', 'Optima',
                'K7', 'Cadenza', 'K8', 'K9', 'Magentis', 'Clarus', 'Sephia', 'Shuma',
                'Potentia', 'Enterprise', 'Concord', 'Capital',

                // SUVs & Crossovers
                'Sportage', 'Seltos', 'Niro', 'Sorento', 'Mohave', 'Telluride',
                'Stonic', 'Soul', 'Soul EV', 'EV3', 'EV5', 'EV6', 'EV9', 'EV4',
                'KX3', 'KX5', 'KX7', 'Borrego',

                // Hatchbacks
                'Picanto', 'Morning', 'Ray', 'Ceed', 'ProCeed', 'Venga', 'Carens',
                'Ceed GT', 'ProCeed GT',

                // Vans
                'Carnival', 'Sedona', 'Carens', 'Joice', 'BestA', 'Pregio',
                'K2500', 'K2700', 'K3000', 'Bongo', 'Travello',

                // Electric
                'EV6', 'EV9', 'EV3', 'EV5', 'EV4', 'Niro EV', 'Soul EV',
                'EV6 GT', 'EV9 GT',

                // Commercial
                'Bongo', 'K2500', 'K2700', 'K3000', 'Travello', 'Pregio', 'BestA'
            ],

            'Honda' => [
                // Sedans
                'Civic', 'Civic Type R', 'Accord', 'Legend', 'Inspire', 'Vigor',
                'City', 'Amaze', 'Brio', 'Fit Aria', 'Ballade', 'Quint',

                // SUVs & Crossovers
                'CR-V', 'HR-V', 'ZR-V', 'Pilot', 'Passport', 'Prologue',
                'Vezel', 'WR-V', 'BR-V', 'Element', 'Crossroad',

                // Hatchbacks
                'Jazz', 'Fit', 'Civic Hatchback', 'CR-Z', 'Insight', 'Clarity',
                'Logo', 'Capa', 'That\'s', 'Life', 'N-One', 'N-Box', 'N-WGN', 'N-VAN',

                // Vans & Minivans
                'Odyssey', 'Stepwgn', 'Freed', 'Elysion', 'Stream', 'Edix',
                'FR-V', 'Mobilio', 'Acty', 'Vamos', 'N-VAN',

                // Pickups & Trucks
                'Ridgeline', 'Touring', 'Pilot',

                // Sports Cars
                'NSX', 'S2000', 'Integra', 'Prelude', 'Beat', 'CR-X', 'Del Sol',

                // Electric & Hybrid
                'e', 'e:Ny1', 'CR-Z', 'Insight', 'Clarity', 'Fit Hybrid',
                'Civic Hybrid', 'Accord Hybrid', 'NSX Hybrid'
            ]
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
