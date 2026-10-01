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
            'Seafood',
            'Gorengan',
            'Bakaran',
            'Panggang',
            'Rebus',
            'Sambal',
            'Makanan Tradisional',
            'Minuman',
        ];

        $menuNames = [
            'Seafood' => ['Udang Sambal Matah', 'Ikan Bakar Rempah', 'Cumi Saus Padang', 'Kepiting Saus Tiram'],
            'Gorengan' => ['Ayam Goreng Lengkuas', 'Tahu Crispy Bumbu Rujak', 'Tempe Mendoan', 'Bakwan Jagung'],
            'Bakaran' => ['Ayam Bakar Taliwang', 'Ikan Bakar Jimbaran', 'Sate Ayam Madura', 'Ribs Bakar Bumbu Bali'],
            'Panggang' => ['Beef Panggang Lada Hitam', 'Ayam Panggang Woku', 'Ikan Panggang Bumbu Kuning', 'Udang Panggang Mentega'],
            'Rebus' => ['Soto Betawi', 'Sop Buntut', 'Bakso Urat Special', 'Rawon Nguling'],
            'Sambal' => ['Ayam Penyet Sambal Bawang', 'Belut Crispy Sambal Ijo', 'Paru Sambal Matah', 'Telur Balado'],
            'Makanan Tradisional' => ['Nasi Tumpeng Komplit', 'Gudeg Jogja', 'Pempek Palembang', 'Rendang Daging'],
            'Minuman' => ['Es Teh Manis Jumbo', 'Es Jeruk Peras', 'Wedang Jahe', 'Es Cincau Hijau'],
        ];

        foreach ($categories as $i => $name) {
            $category = Category::firstOrCreate(
                ['name' => $name],
                [
                    'description' => "Pilihan terbaik hidangan {$name} khas nusantara.",
                    'sort_order' => $i,
                ]
            );

            foreach ($menuNames[$name] ?? [] as $j => $menuName) {
                Menu::firstOrCreate(
                    ['slug' => \Illuminate\Support\Str::slug($menuName)],
                    [
                        'category_id' => $category->id,
                        'name' => $menuName,
                        'description' => 'Diolah dari bahan pilihan dan resep otentik warisan nusantara, disajikan dengan sepenuh hati.',
                        'price' => rand(25, 150) * 1000,
                        'rating' => rand(40, 50) / 10,
                        'featured' => $j === 0,
                    ]
                );
            }
        }

        if (Team::count() === 0) {
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
        }

        if (Gallery::count() === 0) {
            $galleryCategories = ['interior', 'food', 'kitchen', 'event', 'customer'];
            foreach (range(1, 10) as $i) {
                Gallery::create([
                    'title' => "Galeri {$i}",
                    'category' => $galleryCategories[array_rand($galleryCategories)],
                    'image' => 'images/placeholder-gallery.jpg',
                    'sort_order' => $i,
                ]);
            }
        }

        if (Testimonial::count() === 0) {
            foreach (range(1, 6) as $i) {
                Testimonial::create([
                    'name' => "Pelanggan {$i}",
                    'rating' => 5,
                    'message' => 'Rasa masakan yang autentik dengan suasana restoran yang elegan. Pelayanan sangat memuaskan!',
                ]);
            }
        }
    }
}
