<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Selera Nusantara',
                'password' => bcrypt('password'),
                'role' => 'super_admin',
            ]
        );

        Setting::firstOrCreate(
            ['id' => 1],
            [
                'restaurant_name' => 'Selera Nusantara',
                'tagline' => 'Cita Rasa Nusantara dalam Setiap Sajian',
                'address' => 'Jl. Kuliner Nusantara No. 88, Jakarta Selatan',
                'phone' => '(021) 555-1234',
                'whatsapp' => '6281234567890',
                'email' => 'info@selera-nusantara.test',
                'instagram' => 'selera.nusantara',
                'facebook' => 'seleranusantara',
                'youtube' => 'seleranusantara',
                'opening_hours' => [
                    'Senin - Jumat' => '10.00 - 22.00',
                    'Sabtu - Minggu' => '09.00 - 23.00',
                ],
            ]
        );

        $categories = [
            'Makanan Tradisional', 'Ayam', 'Seafood', 'Sup', 'Dessert', 'Minuman',
        ];

        foreach ($categories as $i => $name) {
            $category = Category::firstOrCreate(
                ['name' => $name],
                [
                    'description' => "Pilihan terbaik hidangan {$name} khas nusantara.",
                    'sort_order' => $i,
                ]
            );

            for ($j = 1; $j <= 4; $j++) {
                $slug = \Str::slug("{$name} Spesial {$j}");
                Menu::firstOrCreate(
                    ['slug' => $slug],
                    [
                        'category_id' => $category->id,
                        'name' => "{$name} Spesial {$j}",
                        'description' => 'Diolah dari bahan pilihan dan resep otentik warisan nusantara.',
                        'price' => rand(25, 150) * 1000,
                        'rating' => rand(40, 50) / 10,
                        'featured' => $j === 1,
                    ]
                );
            }
        }

        $team = [
            ['name' => 'Budi Santoso', 'position' => 'Owner'],
            ['name' => 'Chef Made Wirawan', 'position' => 'Executive Chef'],
            ['name' => 'Siti Rahmawati', 'position' => 'Restaurant Manager'],
            ['name' => 'Andi Prasetyo', 'position' => 'Cashier'],
            ['name' => 'Dewi Lestari', 'position' => 'Waiter'],
            ['name' => 'Rina Amelia', 'position' => 'Customer Service'],
        ];

        foreach ($team as $i => $member) {
            Team::create($member + ['sort_order' => $i]);
        }

        $galleryCategories = ['interior', 'food', 'kitchen', 'event', 'customer'];
        foreach (range(1, 10) as $i) {
            Gallery::create([
                'title' => "Galeri {$i}",
                'category' => $galleryCategories[array_rand($galleryCategories)],
                'image' => 'images/placeholder-gallery.jpg',
                'sort_order' => $i,
            ]);
        }

        foreach (range(1, 6) as $i) {
            Testimonial::create([
                'name' => "Pelanggan {$i}",
                'rating' => 5,
                'message' => 'Rasa masakan yang autentik dengan suasana restoran yang elegan. Pelayanan sangat memuaskan!',
            ]);
        }
    }
}
