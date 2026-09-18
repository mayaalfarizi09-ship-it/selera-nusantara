<x-layouts.app :title="'Menu — Selera Nusantara'">

    <section class="relative flex h-[45vh] min-h-[320px] items-center justify-center overflow-hidden bg-ink">
        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2000&auto=format&fit=crop" alt="Menu Selera Nusantara" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative text-center text-white" data-aos="fade-up">
            <h1 class="font-heading text-4xl font-bold sm:text-5xl">Menu Kami</h1>
            <p class="mt-3 text-white/80">Beranda / Menu</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('menu.index') }}" class="mb-12 flex flex-col gap-4 md:flex-row md:items-center md:justify-between" data-aos="fade-up">
            <div class="relative w-full md:max-w-sm">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari menu favorit Anda..."
                       class="w-full rounded-full border border-border py-3 pl-11 pr-4 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                <svg class="absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-ink/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"/>
                </svg>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('menu.index') }}"
                   class="rounded-full px-4 py-2 text-sm font-medium transition-colors {{ !request('category') ? 'bg-primary text-white' : 'bg-accent text-ink/70 hover:bg-primary/10' }}">
                    Semua
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('menu.index', array_filter(['category' => $cat->slug, 'q' => request('q')])) }}"
                       class="rounded-full px-4 py-2 text-sm font-medium transition-colors {{ request('category') === $cat->slug ? 'bg-primary text-white' : 'bg-accent text-ink/70 hover:bg-primary/10' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </form>

        {{-- Menu Grid --}}
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($menus as $menu)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 80 }}"
                     class="group overflow-hidden rounded-2xl border border-border bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative h-56 overflow-hidden bg-accent">
                        <img src="{{ $menu->image ? asset('storage/'.$menu->image) : 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=800&auto=format&fit=crop' }}"
                             alt="{{ $menu->name }}" class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-110" loading="lazy">
                        @if ($menu->featured)
                            <span class="absolute left-4 top-4 rounded-full bg-primary px-3 py-1 text-xs font-semibold text-white">Unggulan</span>
                        @endif
                        <span class="absolute right-4 top-4 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-ink">{{ $menu->category->name }}</span>
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
                <p class="col-span-3 text-center text-ink/50">Menu tidak ditemukan.</p>
            @endforelse
        </div>

        <div class="mt-14">
            {{ $menus->links() }}
        </div>
    </section>

</x-layouts.app>
