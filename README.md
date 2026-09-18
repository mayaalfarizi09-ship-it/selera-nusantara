# Selera Nusantara — Company Profile Website

Website company profile premium untuk restoran Indonesia, dibangun dengan **Laravel 12**, **Filament v5**, **Blade + Tailwind CSS + Alpine.js**, mengikuti gaya referensi [bungakampoeng.com](https://www.bungakampoeng.com/) (navbar sticky transparan → solid, hero banner foto besar full screen, halaman terpisah per menu navigasi).

## ⚠️ Cara Menjalankan (Penting)

Kode di sini adalah **source code aplikasi** (app, database, resources, routes, config inti). Karena folder `vendor/` (dependency Composer) berukuran besar dan perlu diunduh dari internet, Anda perlu menjalankan langkah berikut di komputer/server Anda yang terhubung internet:

```bash
# 1. Buat project Laravel 12 kosong terlebih dahulu
composer create-project laravel/laravel selera-nusantara
cd selera-nusantara

# 2. Install Filament v5
composer require filament/filament:"^5.0"
php artisan filament:install --panels

# 3. Install package pendukung
composer require spatie/laravel-sluggable
npm install alpinejs aos

# 4. SALIN semua file dari paket ini ke dalam project,
#    menimpa (overwrite) file bawaan Laravel yang sama:
#    - app/
#    - database/
#    - resources/
#    - routes/
#    - bootstrap/app.php, bootstrap/providers.php
#    - tailwind.config.js, vite.config.js, postcss.config.js, package.json

# 5. Salin .env.example ke .env dan sesuaikan DB
cp .env.example .env
php artisan key:generate

# 6. Migrasi & seed database
php artisan migrate --seed
php artisan storage:link

# 7. Build asset frontend
npm install
npm run dev   # atau: npm run build

# 8. Jalankan server
php artisan serve
```

Login Admin (Filament v5): `http://localhost:8000/admin`
- Email: `admin@selera-nusantara.test`
- Password: `password`

## 📁 Struktur yang Disertakan

```
app/
  Models/            → Category, Menu, Gallery, Team, Testimonial, Reservation, ContactMessage, Setting, User
  Http/Controllers/  → Home, About, Menu, Gallery, Team, Contact, Reservation
  Http/Requests/      → ContactMessageRequest, ReservationRequest
  Filament/
    Resources/        → CategoryResource, MenuResource, GalleryResource, TeamResource,
                         TestimonialResource, ReservationResource, ContactMessageResource
    Pages/SettingsPage.php
    Widgets/           → StatsOverviewWidget, RecentReservationsWidget
  Providers/Filament/AdminPanelProvider.php

database/
  migrations/         → settings, categories, menus, galleries, teams, testimonials,
                         reservations, contact_messages, users.role
  seeders/DatabaseSeeder.php

resources/views/
  layouts/app.blade.php
  components/navbar.blade.php, footer.blade.php, logo.blade.php
  pages/home.blade.php            ← Landing page dengan HERO BANNER FULL SCREEN
  pages/about/index.blade.php
  pages/menu/index.blade.php, show.blade.php
  pages/gallery/index.blade.php
  pages/team/index.blade.php
  pages/contact/index.blade.php
  pages/reservation/index.blade.php

routes/web.php         → setiap menu navigasi = halaman terpisah (bukan one-page scroll)
```

## 🖼️ Logo

Taruh file logo Anda di `public/images/logo.png`. Jika file tidak ada, sistem otomatis
menampilkan teks **"Selera Nusantara"** warna `#A80707` di Navbar, Footer, Login Page,
Filament Admin, dan Loading Screen — tanpa perlu ubah kode apa pun (lihat `x-logo`
component di `resources/views/components/logo.blade.php`).

## 🎨 Palet Warna

| Nama      | Hex       |
|-----------|-----------|
| Primary   | `#A80707` |
| Secondary | `#FFFFFF` |
| Accent    | `#F8F5F0` |
| Text      | `#222222` |
| Border    | `#ECECEC` |
| Hover     | `#8B0505` |

## 🖼️ Banner Foto Besar di Landing Page

Section hero di `resources/views/pages/home.blade.php` menggunakan foto full-screen
(100vh) dengan overlay gradient gelap, parallax scroll, efek steam, dan floating food
decoration — sesuai referensi. Saat ini foto memakai URL Unsplash sebagai placeholder;
ganti `src` gambar tersebut dengan foto restoran Anda sendiri (disarankan taruh di
`public/images/hero-banner.jpg` lalu ganti `src` menjadi `{{ asset('images/hero-banner.jpg') }}`).

## ✅ Yang Sudah Termasuk

- Migration, Model, Controller, Form Request, Routes lengkap sesuai struktur database yang diminta
- Filament v5 Resources untuk semua CRUD (Category, Menu, Gallery, Team, Testimonial,
  Reservation, Contact Messages) + Settings page + Dashboard widgets
- Landing page dengan hero banner besar, featured menu, about preview, why choose us,
  statistik animasi counter, gallery preview, testimonials, reservation CTA
- Halaman terpisah: About (timeline, visi-misi), Menu (search + filter kategori +
  pagination), Gallery (lightbox + filter kategori), Team, Contact (form + Google Maps + FAQ), Reservation
- Navbar sticky transparan → solid saat scroll, dengan smooth transition
- AOS animation (fade up/down/left/right, zoom), counter animation, button ripple
- Responsive (mobile, tablet, laptop, desktop)
- SEO: meta title/description, Open Graph, Twitter Card, robots.txt

## 🔜 Langkah Lanjutan yang Disarankan

- Tambahkan `sitemap.xml` dinamis (misal package `spatie/laravel-sitemap`)
- Tambahkan Policy untuk otorisasi resource Filament sesuai role
- Tambahkan factory + PHPUnit test untuk tiap model
- Optimasi gambar (WebP, lazy load — sudah diterapkan `loading="lazy"` di banyak tempat)
- Ganti seluruh gambar placeholder Unsplash dengan foto asli restoran Anda
