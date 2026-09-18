<x-layouts.app :title="'Selera Nusantara — Restoran Nusantara Premium'">

    {{-- ============ HERO BANNER (Full Screen, Big Photo) ============ --}}
    <section class="relative flex h-screen min-h-[640px] w-full items-center justify-center overflow-hidden bg-ink">

        {{-- Big background photo with parallax --}}
        <div class="absolute inset-0" x-data x-init="
            window.addEventListener('scroll', () => {
                $el.style.transform = `translateY(${window.scrollY * 0.35}px)`;
            });
        ">
            <img
                src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2000&auto=format&fit=crop"
                alt="Suasana Restoran Selera Nusantara"
                class="h-[120%] w-full object-cover"
                onerror="this.src='{{ asset('images/hero-placeholder.jpg') }}'"
            >
        </div>

        {{-- Dark gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/40"></div>

        {{-- Floating food decoration --}}
        <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?q=80&w=400&auto=format&fit=crop"
             alt="" class="absolute -left-10 top-24 hidden h-40 w-40 rounded-full border-4 border-white/20 object-cover shadow-2xl animate-floaty lg:block" loading="lazy">
        <img src="https://images.unsplash.com/photo-1600628421066-f6bda6a7b976?q=80&w=400&auto=format&fit=crop"
             alt="" class="absolute -right-6 bottom-40 hidden h-36 w-36 rounded-full border-4 border-white/20 object-cover shadow-2xl animate-floaty lg:block" style="animation-delay:1.5s" loading="lazy">

        {{-- Animated steam effect --}}
        <div class="pointer-events-none absolute bottom-24 left-1/2 hidden -translate-x-1/2 gap-3 sm:flex">
            <span class="h-16 w-6 rounded-full bg-white/20 blur-md animate-steam"></span>
            <span class="h-16 w-6 rounded-full bg-white/20 blur-md animate-steam" style="animation-delay:.6s"></span>
            <span class="h-16 w-6 rounded-full bg-white/20 blur-md animate-steam" style="animation-delay:1.2s"></span>
        </div>

        {{-- Content --}}
        <div class="relative z-10 mx-auto max-w-4xl px-6 text-center" data-aos="fade-up">
            <p class="font-heading text-sm font-semibold uppercase tracking-[0.3em] text-white/80">
                Selamat Datang di
            </p>
            <h1 class="mt-3 font-heading text-5xl font-extrabold leading-tight text-white sm:text-6xl lg:text-7xl">
                SELERA NUSANTARA
            </h1>
            <p class="mx-auto mt-5 max-w-xl font-heading text-xl font-medium text-white/90 sm:text-2xl">
                "Cita Rasa Nusantara dalam Setiap Sajian"
            </p>
            <p class="mx-auto mt-4 max-w-lg text-sm text-white/70 sm:text-base">
                Nikmati perpaduan resep otentik warisan nusantara dengan suasana bersantap premium yang elegan dan hangat.
            </p>

            <div class="mt-9 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('menu.index') }}" class="btn-primary ripple">
                    Jelajahi Menu
                </a>
                <a href="{{ route('reservation.index') }}" class="btn-outline ripple">
                    Reservasi Meja
                </a>
            </div>
        </div>

        {{-- Mouse scroll indicator --}}
        <div class="absolute bottom-8 left-1/2 z-10 -translate-x-1/2 animate-bounce">
            <div class="flex h-10 w-6 items-start justify-center rounded-full border-2 border-white/60 p-1">
                <span class="h-2 w-1 rounded-full bg-white/80"></span>
            </div>
        </div>
    </section>

    {{-- ============ ABOUT PREVIEW ============ --}}
    <section class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
        <div class="grid items-center gap-14 lg:grid-cols-2">
            <div data-aos="fade-right" class="relative">
                <img src="https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?q=80&w=1200&auto=format&fit=crop"
                     alt="Suasana dapur Selera Nusantara" class="aspect-[4/5] w-full rounded-2xl object-cover shadow-xl" loading="lazy">
                <div class="absolute -bottom-8 -right-8 hidden rounded-2xl bg-primary p-6 text-white shadow-xl sm:block">
                    <p class="font-heading text-4xl font-bold">12+</p>
                    <p class="text-sm text-white/80">Tahun Pengalaman</p>
                </div>
            </div>
            <div data-aos="fade-left">
                <span class="section-eyebrow">Tentang Kami</span>
                <h2 class="section-heading">Warisan Rasa, Disajikan dengan Elegan</h2>
                <p class="mt-5 leading-relaxed text-ink/70">
                    Selera Nusantara lahir dari kecintaan pada kekayaan kuliner Indonesia. Setiap hidangan kami
                    diracik dari resep otentik turun-temurun, dipadukan dengan bahan pilihan dan sentuhan penyajian
                    modern — menghadirkan pengalaman bersantap yang tak terlupakan bagi keluarga dan kolega Anda.
                </p>
                <ul class="mt-6 space-y-3">
                    @foreach (['Bahan-bahan pilihan dan segar setiap hari', 'Resep otentik warisan nusantara', 'Suasana premium yang nyaman dan elegan'] as $point)
                        <li class="flex items-start gap-3 text-sm text-ink/80">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('about') }}" class="btn-primary ripple mt-8 inline-flex">
                    Selengkapnya Tentang Kami
                </a>
            </div>
        </div>
    </section>

    {{-- ============ FEATURED MENU ============ --}}
    <section class="bg-accent py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-xl text-center" data-aos="fade-up">
                <span class="section-eyebrow">Menu Pilihan</span>
                <h2 class="section-heading">Hidangan Unggulan Kami</h2>
                <p class="mt-4 text-ink/70">Sajian favorit yang paling dicari, dimasak langsung dari dapur Selera Nusantara.</p>
            </div>

            <div class="mt-14 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($featuredMenus as $menu)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}"
                         class="group overflow-hidden rounded-2xl border border-border bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative h-56 overflow-hidden bg-accent">
                            <img src="{{ $menu->image ? asset('storage/'.$menu->image) : 'https://images.unsplash.com/photo-1512058564366-18510be2db19?q=80&w=800&auto=format&fit=crop' }}"
                                 alt="{{ $menu->name }}" class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-110" loading="lazy">
                            <span class="absolute left-4 top-4 rounded-full bg-primary px-3 py-1 text-xs font-semibold text-white">Unggulan</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-heading text-lg font-semibold">{{ $menu->name }}</h3>
                                <span class="flex shrink-0 items-center gap-1 text-sm font-medium text-primary">
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09L5.5 11.545.5 7.41l6.11-.89L10 1l3.39 5.52 6.11.89-5 4.135 1.378 6.545z"/></svg>
                                    {{ number_format($menu->rating, 1) }}
                                </span>
                            </div>
                            <div class="mt-2 line-clamp-2 text-sm text-ink/60">{!! $menu->description !!}</div>
                            <p class="mt-4 font-heading text-lg font-bold text-primary">{{ $menu->formatted_price }}</p>
                        </div>
                    </div>
                @empty
                    @for ($i = 0; $i < 3; $i++)
                        <div class="rounded-2xl border border-border bg-white p-6">
                            <div class="h-56 rounded-xl bg-border"></div>
                            <p class="mt-4 text-sm text-ink/40">Menu akan segera hadir.</p>
                        </div>
                    @endfor
                @endforelse
            </div>

            <div class="mt-12 text-center" data-aos="fade-up">
                <a href="{{ route('menu.index') }}" class="btn-primary ripple">Lihat Semua Menu</a>
            </div>
        </div>
    </section>

    {{-- ============ WHY CHOOSE US ============ --}}
    <section class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
        <div class="mx-auto max-w-xl text-center" data-aos="fade-up">
            <span class="section-eyebrow">Keunggulan</span>
            <h2 class="section-heading">Mengapa Memilih Selera Nusantara</h2>
        </div>

        <div class="mt-14 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @php
                $features = [
                    ['icon' => 'M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5Z', 'title' => 'Lokasi Strategis', 'text' => 'Mudah dijangkau dengan area parkir luas dan nyaman.'],
                    ['icon' => 'M12 2l2.09 6.26L20 9l-5 4.5 1.5 6.5L12 17l-4.5 3 1.5-6.5L4 9l5.91-.74L12 2Z', 'title' => 'Bahan Berkualitas', 'text' => 'Dipilih langsung dari petani dan pemasok terpercaya.'],
                    ['icon' => 'M4 4h16v4H4V4Zm2 6h12v10H6V10Zm2 2v6h8v-6H8Z', 'title' => 'Chef Berpengalaman', 'text' => 'Diracik oleh chef profesional dengan resep otentik.'],
                    ['icon' => 'M12 21s-7-4.35-9.33-8.35C1 9.4 2.6 6 6 6c2 0 3.35 1.1 4 2 0-.9 2-2 4-2 3.4 0 5 3.4 3.33 6.65C19 16.65 12 21 12 21Z', 'title' => 'Dibuat dengan Cinta', 'text' => 'Setiap hidangan disajikan dengan sepenuh hati.'],
                ];
            @endphp
            @foreach ($features as $f)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
                     class="rounded-2xl border border-border p-8 text-center transition-shadow duration-300 hover:shadow-lg">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['icon'] }}"/></svg>
                    </div>
                    <h3 class="mt-5 font-heading text-lg font-semibold">{{ $f['title'] }}</h3>
                    <p class="mt-2 text-sm text-ink/60">{{ $f['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============ STATISTICS ============ --}}
    <section class="relative overflow-hidden bg-primary py-20">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-8 px-6 text-center lg:grid-cols-4 lg:px-8">
            @php
                $statsItems = [
                    ['val' => $stats['years'], 'label' => 'Tahun Pengalaman'],
                    ['val' => $stats['menus'], 'label' => 'Menu Autentik'],
                    ['val' => $stats['customers'], 'label' => 'Pelanggan Puas'],
                    ['val' => $stats['awards'], 'label' => 'Penghargaan'],
                ];
            @endphp
            @foreach ($statsItems as $stat)
                <div data-aos="zoom-in">
                    <p class="font-heading text-4xl font-extrabold text-white sm:text-5xl">
                        <span data-counter="{{ $stat['val'] }}">0</span>+
                    </p>
                    <p class="mt-2 text-sm text-white/80">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============ GALLERY PREVIEW ============ --}}
    <section class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
        <div class="mx-auto max-w-xl text-center" data-aos="fade-up">
            <span class="section-eyebrow">Galeri</span>
            <h2 class="section-heading">Momen di Selera Nusantara</h2>
        </div>

        <div class="mt-14 grid grid-cols-2 gap-4 md:grid-cols-4">
            @php
                $previewImages = [
                    'https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1424847651672-bf20a4b0982b?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?q=80&w=600&auto=format&fit=crop',
                ];
            @endphp
            @foreach ($previewImages as $img)
                <div data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}" class="group overflow-hidden rounded-xl">
                    <img src="{{ $img }}" alt="Galeri Selera Nusantara" class="aspect-square w-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                </div>
            @endforeach
        </div>

        <div class="mt-10 text-center" data-aos="fade-up">
            <a href="{{ route('gallery') }}" class="btn-outline !border-primary !text-primary ripple hover:!bg-primary hover:!text-white">
                Lihat Galeri Lengkap
            </a>
        </div>
    </section>

    {{-- ============ TESTIMONIALS ============ --}}
    <section class="bg-accent py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-xl text-center" data-aos="fade-up">
                <span class="section-eyebrow">Testimoni</span>
                <h2 class="section-heading">Apa Kata Pelanggan Kami</h2>
            </div>

            <div class="mt-14 grid grid-cols-1 gap-8 md:grid-cols-3">
                @forelse ($testimonials->take(3) as $t)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="rounded-2xl bg-white p-8 shadow-sm">
                        <div class="flex gap-1 text-primary">
                            @for ($i = 0; $i < $t->rating; $i++)
                                <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09L5.5 11.545.5 7.41l6.11-.89L10 1l3.39 5.52 6.11.89-5 4.135 1.378 6.545z"/></svg>
                            @endfor
                        </div>
                        <p class="mt-4 text-sm italic leading-relaxed text-ink/70">"{{ $t->message }}"</p>
                        <p class="mt-5 font-heading text-sm font-semibold">{{ $t->name }}</p>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-ink/50">Belum ada testimoni.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ============ RESERVATION CTA ============ --}}
    <section class="relative overflow-hidden py-24">
        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2000&auto=format&fit=crop"
             alt="" class="absolute inset-0 h-full w-full object-cover" loading="lazy">
        <div class="absolute inset-0 bg-ink/80"></div>
        <div class="relative mx-auto max-w-2xl px-6 text-center" data-aos="fade-up">
            <span class="font-heading text-sm font-semibold uppercase tracking-widest text-white/70">Bersantap Bersama Kami</span>
            <h2 class="mt-3 font-heading text-3xl font-bold text-white md:text-4xl">Pesan Meja Anda Sekarang</h2>
            <p class="mt-4 text-white/70">Amankan meja terbaik untuk momen spesial Anda bersama keluarga dan orang tersayang.</p>
            <a href="{{ route('reservation.index') }}" class="btn-primary ripple mt-8 inline-flex">Reservasi Sekarang</a>
        </div>
    </section>

</x-layouts.app>
