<x-layouts.app :title="'Tim Kami — Selera Nusantara'">

    <section class="relative flex h-[45vh] min-h-[320px] items-center justify-center overflow-hidden bg-ink">
        <img src="https://images.unsplash.com/photo-1600891964092-4316c288032e?q=80&w=2000&auto=format&fit=crop" alt="Tim Selera Nusantara" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative text-center text-white" data-aos="fade-up">
            <h1 class="font-heading text-4xl font-bold sm:text-5xl">Tim Kami</h1>
            <p class="mt-3 text-white/80">Beranda / Tim Kami</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
        <div class="mx-auto max-w-xl text-center" data-aos="fade-up">
            <span class="section-eyebrow">Di Balik Selera Nusantara</span>
            <h2 class="section-heading">Orang-Orang di Balik Setiap Hidangan</h2>
        </div>

        <div class="mt-14 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($team as $member)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 100 }}"
                     class="group overflow-hidden rounded-2xl border border-border bg-white shadow-sm transition-shadow duration-300 hover:shadow-xl">
                    <div class="relative h-72 overflow-hidden">
                        <img src="{{ $member->photo ? asset('storage/'.$member->photo) : 'https://images.unsplash.com/photo-1607990281513-2c110a25bd8c?q=80&w=600&auto=format&fit=crop' }}"
                             alt="{{ $member->name }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="font-heading text-lg font-semibold">{{ $member->name }}</h3>
                        <p class="mt-1 text-sm font-medium text-primary">{{ $member->position }}</p>
                        @if ($member->description)
                            <p class="mt-3 text-sm text-ink/60">{{ $member->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-ink/50">Data tim belum tersedia.</p>
            @endforelse
        </div>
    </section>

</x-layouts.app>
