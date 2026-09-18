<x-layouts.app :title="'Tentang Kami — Selera Nusantara'">

    {{-- Page Banner --}}
    <section class="relative flex h-[45vh] min-h-[320px] items-center justify-center overflow-hidden bg-ink">
        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2000&auto=format&fit=crop" alt="Tentang Selera Nusantara" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative text-center text-white" data-aos="fade-up">
            <h1 class="font-heading text-4xl font-bold sm:text-5xl">Tentang Kami</h1>
            <p class="mt-3 text-white/80">Beranda / Tentang Kami</p>
        </div>
    </section>

    {{-- Company Profile --}}
    <section class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
        <div class="grid items-center gap-14 lg:grid-cols-2">
            <div data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=1200&auto=format&fit=crop" alt="Restoran Selera Nusantara" class="aspect-[4/3] w-full rounded-2xl object-cover shadow-xl">
            </div>
            <div data-aos="fade-left">
                <span class="section-eyebrow">Profil Perusahaan</span>
                <h2 class="section-heading">Cerita di Balik Selera Nusantara</h2>
                <p class="mt-5 leading-relaxed text-ink/70">
                    Berawal dari kecintaan mendalam terhadap kekayaan kuliner Indonesia, Selera Nusantara hadir
                    sebagai destinasi bersantap yang menggabungkan resep otentik warisan keluarga dengan sentuhan
                    penyajian premium modern. Kami percaya bahwa setiap hidangan menyimpan cerita, dan kami ingin
                    membagikannya kepada setiap tamu yang datang.
                </p>
                <p class="mt-4 leading-relaxed text-ink/70">
                    Kini, Selera Nusantara telah menjadi pilihan keluarga modern yang mencari pengalaman kuliner
                    nusantara autentik dalam suasana yang elegan dan nyaman.
                </p>
            </div>
        </div>
    </section>

    {{-- Vision, Mission, Core Values --}}
    <section class="bg-accent py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div data-aos="fade-up" class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="font-heading text-xl font-bold text-primary">Visi</h3>
                    <p class="mt-3 text-sm leading-relaxed text-ink/70">
                        Menjadi restoran nusantara premium terdepan yang melestarikan dan mengangkat cita rasa
                        kuliner Indonesia ke level yang lebih tinggi.
                    </p>
                </div>
                <div data-aos="fade-up" data-aos-delay="100" class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="font-heading text-xl font-bold text-primary">Misi</h3>
                    <ul class="mt-3 space-y-2 text-sm leading-relaxed text-ink/70">
                        <li>Menyajikan hidangan nusantara autentik berkualitas tinggi.</li>
                        <li>Memberikan pelayanan terbaik bagi setiap tamu.</li>
                        <li>Menciptakan suasana bersantap yang nyaman dan berkesan.</li>
                    </ul>
                </div>
                <div data-aos="fade-up" data-aos-delay="200" class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="font-heading text-xl font-bold text-primary">Nilai Inti</h3>
                    <ul class="mt-3 space-y-2 text-sm leading-relaxed text-ink/70">
                        <li>Keaslian rasa dan resep.</li>
                        <li>Keramahan dan kehangatan pelayanan.</li>
                        <li>Kualitas bahan dan kebersihan terjaga.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Advantages --}}
    <section class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
        <div class="mx-auto max-w-xl text-center" data-aos="fade-up">
            <span class="section-eyebrow">Keunggulan Kami</span>
            <h2 class="section-heading">Mengapa Selera Nusantara Berbeda</h2>
        </div>
        <div class="mt-14 grid grid-cols-1 gap-6 sm:grid-cols-2">
            @foreach ([
                'Resep otentik turun-temurun dari berbagai daerah di Indonesia',
                'Bahan baku segar yang dipilih langsung setiap hari',
                'Chef profesional dengan pengalaman lebih dari satu dekade',
                'Suasana restoran elegan, nyaman, untuk keluarga maupun acara khusus',
            ] as $point)
                <div data-aos="fade-up" class="flex items-start gap-4 rounded-xl border border-border p-6">
                    <svg class="mt-1 h-6 w-6 shrink-0 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-sm text-ink/80">{{ $point }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Timeline --}}
    <section class="bg-accent py-24">
        <div class="mx-auto max-w-4xl px-6 lg:px-8">
            <div class="mx-auto max-w-xl text-center" data-aos="fade-up">
                <span class="section-eyebrow">Perjalanan Kami</span>
                <h2 class="section-heading">Timeline Selera Nusantara</h2>
            </div>

            <div class="mt-14 space-y-10 border-l-2 border-primary/30 pl-8">
                @foreach ($timeline as $item)
                    <div data-aos="fade-up" class="relative">
                        <span class="absolute -left-[38px] top-1 h-4 w-4 rounded-full border-4 border-white bg-primary"></span>
                        <p class="font-heading text-sm font-bold text-primary">{{ $item['year'] }}</p>
                        <h3 class="mt-1 font-heading text-lg font-semibold">{{ $item['title'] }}</h3>
                        <p class="mt-1 text-sm text-ink/70">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-layouts.app>
