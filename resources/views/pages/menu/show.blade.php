<x-layouts.app :title="$menu->name.' — Selera Nusantara'">

    <section class="mx-auto max-w-6xl px-6 py-28 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-2">
            <div data-aos="fade-right">
                <img src="{{ $menu->image ? asset('storage/'.$menu->image) : 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=1000&auto=format&fit=crop' }}"
                     alt="{{ $menu->name }}" class="aspect-square w-full rounded-2xl object-cover shadow-xl">
            </div>
            <div data-aos="fade-left">
                <span class="rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary">{{ $menu->category->name }}</span>
                <h1 class="mt-4 font-heading text-3xl font-bold">{{ $menu->name }}</h1>
                <div class="mt-2 flex items-center gap-1 text-primary">
                    @for ($i = 0; $i < round($menu->rating); $i++)
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09L5.5 11.545.5 7.41l6.11-.89L10 1l3.39 5.52 6.11.89-5 4.135 1.378 6.545z"/></svg>
                    @endfor
                    <span class="ml-1 text-sm text-ink/60">({{ $menu->rating }})</span>
                </div>
                <p class="mt-6 font-heading text-3xl font-bold text-primary">{{ $menu->formatted_price }}</p>
                <div class="mt-6 leading-relaxed text-ink/70">{!! $menu->description !!}</div>
                <a href="{{ route('reservation.index') }}" class="btn-primary ripple mt-8 inline-flex">Reservasi untuk Mencicipi</a>
            </div>
        </div>

        @if ($related->isNotEmpty())
            <div class="mt-24">
                <h2 class="section-heading">Menu Lainnya</h2>
                <div class="mt-8 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($related as $item)
                        <a href="{{ route('menu.show', $item) }}" class="group overflow-hidden rounded-2xl border border-border bg-white shadow-sm transition-shadow hover:shadow-lg">
                            <div class="h-40 overflow-hidden bg-accent">
                                <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=600&auto=format&fit=crop' }}"
                                     class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-110" alt="{{ $item->name }}">
                            </div>
                            <div class="p-4">
                                <h3 class="font-heading text-sm font-semibold">{{ $item->name }}</h3>
                                <p class="mt-1 text-sm font-bold text-primary">{{ $item->formatted_price }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

</x-layouts.app>
