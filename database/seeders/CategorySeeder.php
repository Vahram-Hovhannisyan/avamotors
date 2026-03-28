<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Clear nav.php cache after seeding
        Cache::forget('nav_categories');

        $tree = [

            // ── ЗАЖИГАНИЕ ──────────────────────────────
            [
                'name'        => 'Зажигание',
                'slug'        => 'ignition',
                'description' => 'Система зажигания: свечи, катушки, провода, колпачки',
                'sort_order'  => 1,
                'children'    => [
                    ['name' => 'Свечи зажигания',    'slug' => 'plugs',       'description' => 'Стандартные, иридиевые, платиновые свечи NGK, Bosch, Denso', 'sort_order' => 1],
                    ['name' => 'Катушки зажигания',  'slug' => 'coils',       'description' => 'Индивидуальные и модульные катушки зажигания',                'sort_order' => 2],
                    ['name' => 'Высоковольтные провода', 'slug' => 'ht-leads', 'description' => 'Комплекты высоковольтных проводов',                          'sort_order' => 3],
                    ['name' => 'Защитные колпачки',  'slug' => 'caps',        'description' => 'Колпачки для свечей и высоковольтных проводов',               'sort_order' => 4],
                ],
            ],

//            // ── ХОДОВАЯ ЧАСТЬ ───────────────────────────
//            [
//                'name'        => 'Ходовая часть',
//                'slug'        => 'suspension',
//                'description' => 'Подвеска, рулевое управление, ступицы',
//                'sort_order'  => 2,
//                'children'    => [
//                    ['name' => 'Амортизаторы и стойки', 'slug' => 'shock-absorbers', 'description' => 'Амортизаторы, газомасляные стойки, пружины',        'sort_order' => 1],
//                    ['name' => 'Сайлентблоки',          'slug' => 'bushings',         'description' => 'Сайлентблоки рычагов, подрамника, стабилизатора',   'sort_order' => 2],
//                    ['name' => 'Шаровые опоры',         'slug' => 'ball-joints',      'description' => 'Верхние и нижние шаровые опоры',                    'sort_order' => 3],
//                    ['name' => 'Рулевые наконечники',   'slug' => 'tie-rods',         'description' => 'Рулевые наконечники и тяги',                        'sort_order' => 4],
//                    ['name' => 'Подшипники ступицы',    'slug' => 'wheel-bearings',   'description' => 'Передние и задние ступичные подшипники',             'sort_order' => 5],
//                    ['name' => 'Стабилизаторы',         'slug' => 'stabilizers',      'description' => 'Стойки и втулки стабилизатора поперечной устойчивости', 'sort_order' => 6],
//                ],
//            ],
//
//            // ── ТОРМОЗНАЯ СИСТЕМА ───────────────────────
//            [
//                'name'        => 'Тормозная система',
//                'slug'        => 'brakes',
//                'description' => 'Тормозные диски, колодки, суппорты, шланги',
//                'sort_order'  => 3,
//                'children'    => [
//                    ['name' => 'Тормозные диски',   'slug' => 'brake-discs',  'description' => 'Вентилируемые и сплошные тормозные диски',       'sort_order' => 1],
//                    ['name' => 'Тормозные колодки', 'slug' => 'brake-pads',   'description' => 'Передние и задние тормозные колодки',             'sort_order' => 2],
//                    ['name' => 'Тормозные суппорты','slug' => 'calipers',     'description' => 'Суппорты и ремкомплекты суппортов',               'sort_order' => 3],
//                    ['name' => 'Тормозные шланги',  'slug' => 'brake-hoses',  'description' => 'Гибкие тормозные шланги и трубки',               'sort_order' => 4],
//                ],
//            ],
//
//            // ── ФИЛЬТРЫ ─────────────────────────────────
//            [
//                'name'        => 'Фильтры',
//                'slug'        => 'filters',
//                'description' => 'Масляные, воздушные, топливные и салонные фильтры',
//                'sort_order'  => 4,
//                'children'    => [
//                    ['name' => 'Масляные фильтры',   'slug' => 'oil-filters',    'description' => 'Фильтры моторного масла',          'sort_order' => 1],
//                    ['name' => 'Воздушные фильтры',  'slug' => 'air-filters',    'description' => 'Фильтры воздушного потока',        'sort_order' => 2],
//                    ['name' => 'Топливные фильтры',  'slug' => 'fuel-filters',   'description' => 'Фильтры топливной системы',        'sort_order' => 3],
//                    ['name' => 'Салонные фильтры',   'slug' => 'cabin-filters',  'description' => 'Фильтры кондиционера и вентиляции','sort_order' => 4],
//                ],
//            ],
//
//            // ── МАСЛА И ЖИДКОСТИ ────────────────────────
//            [
//                'name'        => 'Масла и жидкости',
//                'slug'        => 'oils',
//                'description' => 'Моторные масла, трансмиссионные, тормозные жидкости',
//                'sort_order'  => 5,
//                'children'    => [
//                    ['name' => 'Моторные масла',          'slug' => 'engine-oils',       'description' => '5W30, 5W40, 0W20 синтетика и полусинтетика', 'sort_order' => 1],
//                    ['name' => 'Трансмиссионные масла',   'slug' => 'transmission-oils', 'description' => 'Масла для КПП и дифференциалов',              'sort_order' => 2],
//                    ['name' => 'Охлаждающие жидкости',   'slug' => 'coolants',          'description' => 'Антифриз G11, G12, G13',                      'sort_order' => 3],
//                    ['name' => 'Тормозные жидкости',      'slug' => 'brake-fluids',      'description' => 'DOT 4, DOT 5.1',                              'sort_order' => 4],
//                ],
//            ],
//
//            // ── СИСТЕМА ОХЛАЖДЕНИЯ ──────────────────────
//            [
//                'name'        => 'Система охлаждения',
//                'slug'        => 'cooling',
//                'description' => 'Радиаторы, помпы, термостаты, патрубки',
//                'sort_order'  => 6,
//                'children'    => [
//                    ['name' => 'Термостаты',          'slug' => 'thermostats',    'description' => 'Термостаты двигателя и датчики температуры', 'sort_order' => 1],
//                    ['name' => 'Водяные помпы',       'slug' => 'water-pumps',    'description' => 'Насосы охлаждающей жидкости',               'sort_order' => 2],
//                    ['name' => 'Радиаторы',           'slug' => 'radiators',      'description' => 'Радиаторы охлаждения двигателя',            'sort_order' => 3],
//                    ['name' => 'Патрубки и шланги',   'slug' => 'cooling-hoses',  'description' => 'Патрубки системы охлаждения',              'sort_order' => 4],
//                ],
//            ],
//
//            // ── ЭЛЕКТРИКА ───────────────────────────────
//            [
//                'name'        => 'Электрика',
//                'slug'        => 'electrics',
//                'description' => 'Генераторы, стартеры, датчики, реле',
//                'sort_order'  => 7,
//                'children'    => [
//                    ['name' => 'Генераторы',    'slug' => 'alternators', 'description' => 'Генераторы переменного тока',    'sort_order' => 1],
//                    ['name' => 'Стартеры',      'slug' => 'starters',    'description' => 'Стартеры двигателя',            'sort_order' => 2],
//                    ['name' => 'Датчики',       'slug' => 'sensors',     'description' => 'Датчики ABS, кислорода, давления, температуры', 'sort_order' => 3],
//                    ['name' => 'Реле и предохранители', 'slug' => 'relays', 'description' => 'Реле, предохранители, блоки управления', 'sort_order' => 4],
//                ],
//            ],
//
//            // ── ОСВЕЩЕНИЕ ───────────────────────────────
//            [
//                'name'        => 'Освещение',
//                'slug'        => 'lights',
//                'description' => 'Лампы, фары, поворотники, стоп-сигналы',
//                'sort_order'  => 8,
//                'children'    => [
//                    ['name' => 'Лампы головного света', 'slug' => 'headlight-bulbs', 'description' => 'H1, H4, H7, HB3, HB4 — галоген, ксенон, LED', 'sort_order' => 1],
//                    ['name' => 'Лампы салона и прочие', 'slug' => 'interior-bulbs',  'description' => 'Лампы для салона, номерного знака, стоп-сигналов', 'sort_order' => 2],
//                ],
//            ],

            // ── ДВИГАТЕЛЬ ───────────────────────────────
            [
                'name'        => 'Двигатель',
                'slug'        => 'engine',
                'description' => 'Ремни, прокладки, клапаны, поршни',
                'sort_order'  => 9,
                'children'    => [
                    ['name' => 'Ремни ГРМ',       'slug' => 'timing-belts',  'description' => 'Ремни и цепи ГРМ, комплекты с роликами', 'sort_order' => 1],
//                    ['name' => 'Приводные ремни',  'slug' => 'drive-belts',   'description' => 'Поликлиновые ремни, ролики натяжителей', 'sort_order' => 2],
//                    ['name' => 'Прокладки',        'slug' => 'gaskets',       'description' => 'Прокладки ГБЦ, картера, коллекторов',    'sort_order' => 3],
//                    ['name' => 'Клапаны',          'slug' => 'valves',        'description' => 'Впускные и выпускные клапаны',           'sort_order' => 4],
                ],
            ],
        ];

        foreach ($tree as $rootData) {
            $children = $rootData['children'] ?? [];
            unset($rootData['children']);

            $root = Category::updateOrCreate(
                ['slug' => $rootData['slug']],
                array_merge($rootData, ['parent_id' => null])
            );

            foreach ($children as $childData) {
                Category::updateOrCreate(
                    ['slug' => $childData['slug']],
                    array_merge($childData, ['parent_id' => $root->id])
                );
            }
        }

        $total = Category::count();
        $this->command->info("✓ Categories seeded: {$total} total");
        Cache::forget('nav_categories');
    }
}
