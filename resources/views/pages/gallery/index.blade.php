<x-layouts.app :title="'Galeri — Selera Nusantara'">

    <section class="relative flex h-[45vh] min-h-[320px] items-center justify-center overflow-hidden bg-ink">
        <img src="https://images.unsplash.com/photo-1424847651672-bf20a4b0982b?q=80&w=2000&auto=format&fit=crop" alt="Galeri Selera Nusantara" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative text-center text-white" data-aos="fade-up">
            <h1 class="font-heading text-4xl font-bold sm:text-5xl">Galeri</h1>
            <p class="mt-3 text-white/80">Beranda / Galeri</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8" x-data="{ lightbox: false, activeImg: '' }">

        <div class="mb-10 flex flex-wrap justify-center gap-2" data-aos="fade-up">
            <a href="{{ route('gallery') }}" class="rounded-full px-4 py-2 text-sm font-medium {{ !request('category') ? 'bg-primary text-white' : 'bg-accent text-ink/70 hover:bg-primary/10' }}">Semua</a>
            @foreach ($categories as $key => $label)
                <a href="{{ route('gallery', ['category' => $key]) }}"
                   class="rounded-full px-4 py-2 text-sm font-medium {{ request('category') === $key ? 'bg-primary text-white' : 'bg-accent text-ink/70 hover:bg-primary/10' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="columns-2 gap-4 md:columns-3 lg:columns-4 [&>*]:mb-4">
            @forelse ($galleries as $item)
                <button type="button" @click="lightbox = true; activeImg = '{{ $item->image ? asset('storage/'.$item->image) : 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=800&auto=format&fit=crop' }}'"
                        data-aos="zoom-in" class="group block w-full overflow-hidden rounded-xl">
                    <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=800&auto=format&fit=crop' }}"
                         alt="{{ $item->title }}" class="w-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                </button>
            @empty
                <p class="text-center text-ink/50">Belum ada foto galeri.</p>
            @endforelse
        </div>

        <div class="mt-14">{{ $galleries->links() }}</div>

        {{-- Lightbox --}}
        <div x-show="lightbox" x-cloak @keydown.escape.window="lightbox = false" x-transition.opacity
             class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 p-6" @click.self="lightbox = false">
            <button @click="lightbox = false" class="absolute right-6 top-6 text-white/80 hover:text-white">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <img :src="activeImg" class="max-h-[85vh] max-w-full rounded-lg object-contain">
        </div>
    </section>

</x-layouts.app>
