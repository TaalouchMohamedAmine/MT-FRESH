<?php

namespace Database\Seeders;

use App\Models\BusinessSetting;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;

class JuiceCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['slug' => 'citrus', 'sort_order' => 1, 'name' => ['en' => 'Citrus', 'fr' => 'Agrumes', 'ar' => 'حمضيات']],
            ['slug' => 'greens', 'sort_order' => 2, 'name' => ['en' => 'Greens', 'fr' => 'Verts', 'ar' => 'خضروات خضراء']],
            ['slug' => 'fruit-blends', 'sort_order' => 3, 'name' => ['en' => 'Fruit blends', 'fr' => 'Mélanges fruités', 'ar' => 'مزيج الفواكه']],
            ['slug' => 'wellness', 'sort_order' => 4, 'name' => ['en' => 'Wellness', 'fr' => 'Bien-être', 'ar' => 'الصحة والعافية']],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }

        $products = [
            [
                'slug' => 'citrus-sunrise', 'category' => 'citrus', 'featured' => true,
                'name' => ['en' => 'Citrus Sunrise', 'fr' => 'Soleil d’agrumes', 'ar' => 'شروق الحمضيات'],
                'description' => ['en' => 'Orange, ruby grapefruit and a touch of ginger for a bright start.', 'fr' => 'Orange, pamplemousse rose et une touche de gingembre pour bien commencer.', 'ar' => 'برتقال وجريب فروت وردي ولمسة من الزنجبيل لبداية منعشة.'],
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBNcO__9E4es8aBHVZvjGyBwuOHwTVzr_22zRnvE6BBCnniV7qXJsv59bCXdBbK7muOU8X9pHYq7kKo2CpgAPprqKT_bovWoY_2fCa8cn0hI7JQ-mmjIis8RF3kCi5-Djsen17Nu-8dIAzsyWQyYUM6Oxi-TVqSWvLDPfOul4Jd5h51H7c_NO5NalPJyMP2YzJYFFC02pa3Y2GUgCGg5BY2W2Dmy1L54Y6ogdCPk7Q',
            ],
            [
                'slug' => 'green-dynamo', 'category' => 'greens', 'featured' => true,
                'name' => ['en' => 'Green Dynamo', 'fr' => 'Dynamo verte', 'ar' => 'الطاقة الخضراء'],
                'description' => ['en' => 'Green apple, celery and spinach in a crisp, lively blend.', 'fr' => 'Pomme verte, céleri et épinards dans un mélange vif et léger.', 'ar' => 'تفاح أخضر وكرفس وسبانخ في مزيج منعش وحيوي.'],
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDfKEEu3B7FUbKLXzpA2kdcLd8IamWG5nFtiRXKsmJ1V5Nt8T8qZEmfpApkRqwTI2sDZKsjehhRygdhykI39lD5t1hjkOugFETbAqdlykEKrVvy64WgTT8J-tWaZ22-7IwD6ZZI52fp0a3SSSIkorZ3oDX9uIj83Ijh3o2yIOL1_3sGI2g8kbtENQYcJ6XBqSftOd1warsqdAKuXxI55Y2-iHYj5bSnrovchULTo3Y',
            ],
            [
                'slug' => 'berry-glow', 'category' => 'fruit-blends', 'featured' => true,
                'name' => ['en' => 'Berry Glow', 'fr' => 'Éclat de fruits rouges', 'ar' => 'توت متألق'],
                'description' => ['en' => 'A juicy blend of berries with a fresh, gently sweet finish.', 'fr' => 'Un mélange juteux de fruits rouges, frais et délicatement doux.', 'ar' => 'مزيج غني من التوت بنكهة طازجة وحلاوة خفيفة.'],
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCCjp2jTYX2B01OdwcXTvRrfxZ0lFL8fSQU4X3TbyjQFPKVOOJKghGoHehaOockiGdQ9peyrldEXVRZNf1HbPlk0K_SeBpfz962y_I6vmkUq0mGQWF0QzUpsTdlnpd1VnAyJyGsFjJCpbKftAbzeIPEmn_iKiQxu0EayHmsrmX6MBBWXrLr7dIvwkJD5xvN1bR1fg-HvQPhZRt5aVmIDdoEd8tTYKtsHlvUn_D20Tk',
            ],
            [
                'slug' => 'mango-passion-burst', 'category' => 'fruit-blends', 'featured' => false,
                'name' => ['en' => 'Mango Passion Burst', 'fr' => 'Explosion mangue-passion', 'ar' => 'مانجو وباشن فروت'],
                'description' => ['en' => 'Ripe mango and passion fruit with a little fresh mint.', 'fr' => 'Mangue mûre et fruit de la passion avec un peu de menthe fraîche.', 'ar' => 'مانجو ناضج وباشن فروت مع قليل من النعناع الطازج.'],
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAKTuPue3tsJnWJ_NPwZabSakB4wJDHtsXymWtfREVqOck4b-XLEJ7sMOeSkLWss87c4rZIg91GPG2rj0dZHj9wRQASCMKZArK9LRqc_49FTp42lDjPCgVVsealySx99CouYHrRMhsGx9Jye8BTQqT2_2DeCvPOrl43Bsfper-N_HShsrPsn1i3ESMbO5Wav33y03sfA5UB1BEeyfv921uQvImxMEoVA3-o1tuS_TM',
            ],
            [
                'slug' => 'beetroot-radiance', 'category' => 'wellness', 'featured' => false,
                'name' => ['en' => 'Beetroot Radiance', 'fr' => 'Éclat de betterave', 'ar' => 'إشراقة الشمندر'],
                'description' => ['en' => 'Earthy beetroot and crisp apple balanced with a splash of lemon.', 'fr' => 'Betterave douce et pomme croquante relevées d’un filet de citron.', 'ar' => 'شمندر غني وتفاح مقرمش مع لمسة من الليمون.'],
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAERXlW9EEP3I01aKsiOAy0lWcd2A3uvjxpG4NVtLpPdLYo5Bkn2vSbTcqJlgM54sfBk_VXvCavs0Sv0KdUjHC3hIAru8yc0XsCIx0VGVZ6x9UGn2WLt0RlRRAT_WgrRYzMyLKjW_BLnsmiEqmZa-pag90sBpWprhpTAylKGg3QusRI-gTi1D2nAEPYIAFcq2BLcRcQlXSzBmbw2-PCstSHTMYPzxgcdxFS0M-luAw',
            ],
            [
                'slug' => 'golden-turmeric-tonic', 'category' => 'wellness', 'featured' => false,
                'name' => ['en' => 'Golden Turmeric Tonic', 'fr' => 'Tonique au curcuma doré', 'ar' => 'مشروب الكركم الذهبي'],
                'description' => ['en' => 'Fresh turmeric, carrot and citrus for a sunny, warming sip.', 'fr' => 'Curcuma frais, carotte et agrumes pour une gorgée ensoleillée.', 'ar' => 'كركم طازج وجزر وحمضيات لمذاق دافئ ومنعش.'],
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBU1lTZi1IPqh2TTAap9LhC-lnLuBXKSO0mUJwWnOvnoMXA7diXOq1cWpgpUdtdXwto2X79p78-CBsnvdRUNb6KjApA6UGxO5Br8cQ0ReOazrmYnmWTEyVUOwuMW-R_kSA3Ty9DChlRghut7v6cbDBsGSyBCEz6JQ0IAINnYO6x0f9BzznNH_RfY819TPviz361P3iugnSglVRUIj2k9DgkYIolrzIrMeVdHbKGv1c',
            ],
        ];

        foreach ($products as $index => $data) {
            $product = Product::updateOrCreate(['slug' => $data['slug']], [
                'category_id' => Category::where('slug', $data['category'])->value('id'),
                'name' => $data['name'],
                'description' => $data['description'],
                'image_path' => $data['image'],
                'is_available' => true,
                'is_featured' => $data['featured'],
                'sort_order' => $index + 1,
            ]);

            foreach ([
                ['order' => 1, 'volume' => 250, 'label' => ['en' => 'Small · 250 ml', 'fr' => 'Petit · 250 ml', 'ar' => 'صغير · ٢٥٠ مل'], 'price' => 6.500],
                ['order' => 2, 'volume' => 500, 'label' => ['en' => 'Large · 500 ml', 'fr' => 'Grand · 500 ml', 'ar' => 'كبير · ٥٠٠ مل'], 'price' => 10.000],
            ] as $size) {
                ProductSize::updateOrCreate(
                    ['product_id' => $product->id, 'sort_order' => $size['order']],
                    ['volume_ml' => $size['volume'], 'label' => $size['label'], 'price' => $size['price'], 'is_available' => true],
                );
            }
        }

        BusinessSetting::query()->firstOrCreate([], [
            'business_name' => ['en' => 'MT FRESH', 'fr' => 'MT FRESH', 'ar' => 'MT FRESH'],
            'opening_hours' => BusinessSetting::defaultOpeningHours(),
            'delivery_fee' => 0,
            'currency' => 'TND',
        ]);
    }
}
