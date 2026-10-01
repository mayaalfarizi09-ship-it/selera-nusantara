@php
    $navItems = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'Menu', 'route' => 'menu.index'],
        ['label' => 'Tentang Kami', 'route' => 'about'],
        ['label' => 'Galeri', 'route' => 'gallery'],
        ['label' => 'Tim', 'route' => 'team'],
        ['label' => 'Testimonial', 'route' => 'testimonials'],
        ['label' => 'Reservasi', 'route' => 'reservation.index'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];
@endphp

<header id="main-navbar"
        x-data="{ open: false, solid: false }"
        x-init="window.addEventListener('scroll', () => solid = window.scrollY > 40)"
        :class="solid ? 'bg-white shadow-md' : 'bg-transparent'"
        class="fixed inset-x-0 top-0 z-50 transition-all duration-300">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">

        <a href="{{ route('home') }}" class="shrink-0">
            <template x-if="!solid"><x-logo dark /></template>
            <template x-if="solid"><x-logo /></template>
        </a>

        <nav class="hidden items-center gap-6 xl:flex">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   :class="solid ? (@js(request()->routeIs($item['route'])) ? 'text-primary' : 'text-ink hover:text-primary') : 'text-white hover:text-white/70'"
                   class="font-heading text-sm font-medium transition-colors duration-200">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden xl:block">
            <a href="{{ route('reservation.index') }}" class="btn-primary ripple !px-6 !py-2.5 text-sm">
                Reservasi
            </a>
        </div>

        <button @click="open = !open" :class="solid ? 'text-ink' : 'text-white'" class="xl:hidden" aria-label="Buka menu">
            <svg x-show="!open" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" x-cloak class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-cloak x-transition class="max-h-[80vh] overflow-y-auto border-t border-border bg-white px-6 py-4 xl:hidden">
        <nav class="flex flex-col gap-4">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}" class="font-heading text-sm font-medium text-ink hover:text-primary">
                    {{ $item['label'] }}
                </a>
            @endforeach
            <a href="{{ route('reservation.index') }}" class="btn-primary ripple mt-2 text-center text-sm">Reservasi</a>
        </nav>
    </div>
</header>
