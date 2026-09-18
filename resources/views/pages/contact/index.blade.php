<x-layouts.app :title="'Kontak — Selera Nusantara'">

    <section class="relative flex h-[45vh] min-h-[320px] items-center justify-center overflow-hidden bg-ink">
        <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=2000&auto=format&fit=crop" alt="Kontak Selera Nusantara" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative text-center text-white" data-aos="fade-up">
            <h1 class="font-heading text-4xl font-bold sm:text-5xl">Hubungi Kami</h1>
            <p class="mt-3 text-white/80">Beranda / Kontak</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
        <div class="grid gap-14 lg:grid-cols-2">

            {{-- Contact Info + Form --}}
            <div data-aos="fade-right">
                <span class="section-eyebrow">Kontak Kami</span>
                <h2 class="section-heading">Kami Siap Melayani Anda</h2>

                <div class="mt-8 space-y-5 text-sm">
                    <div class="flex items-start gap-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5Z"/></svg>
                        </span>
                        <p class="text-ink/70">{{ $settings->address ?? 'Jl. Kuliner Nusantara No. 88, Jakarta Selatan' }}</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 0 1 2-2h3l2 5-2 1a11 11 0 0 0 5 5l1-2 5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 3 5Z"/></svg>
                        </span>
                        <div>
                            <p class="text-ink/70">{{ $settings->phone ?? '(021) 555-1234' }}</p>
                            <p class="text-ink/70">WhatsApp: +{{ $settings->whatsapp ?? '6281234567890' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4V4Zm0 0 8 8 8-8"/></svg>
                        </span>
                        <p class="text-ink/70">{{ $settings->email ?? 'info@selera-nusantara.test' }}</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"/></svg>
                        </span>
                        <div class="text-ink/70">
                            @forelse ($settings->opening_hours ?? [] as $day => $hours)
                                <p>{{ $day }}: {{ $hours }}</p>
                            @empty
                                <p>Senin - Minggu: 10.00 - 22.00</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mt-8 rounded-xl bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="mt-8 space-y-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Anda" required
                               class="rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Anda" required
                               class="rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subjek"
                           class="w-full rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <textarea name="message" rows="4" placeholder="Pesan Anda" required
                              class="w-full rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">{{ old('message') }}</textarea>
                    @error('name') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                    @error('email') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                    @error('message') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                    <button type="submit" class="btn-primary ripple w-full sm:w-auto">Kirim Pesan</button>
                </form>
            </div>

            {{-- Map --}}
            <div data-aos="fade-left" class="h-full min-h-[420px] overflow-hidden rounded-2xl border border-border">
                <iframe
                    src="{{ $settings->google_maps_embed ?: 'https://www.google.com/maps?q=Jakarta&output=embed' }}"
                    class="h-full w-full" style="min-height:420px" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="bg-accent py-24">
        <div class="mx-auto max-w-3xl px-6 lg:px-8">
            <div class="mx-auto max-w-xl text-center" data-aos="fade-up">
                <span class="section-eyebrow">FAQ</span>
                <h2 class="section-heading">Pertanyaan yang Sering Diajukan</h2>
            </div>

            <div class="mt-12 space-y-4" x-data="{ active: null }">
                @foreach ($faqs as $i => $faq)
                    <div data-aos="fade-up" class="overflow-hidden rounded-xl border border-border bg-white">
                        <button @click="active = active === {{ $i }} ? null : {{ $i }}"
                                class="flex w-full items-center justify-between px-6 py-4 text-left font-heading text-sm font-semibold">
                            {{ $faq['q'] }}
                            <svg class="h-5 w-5 shrink-0 transition-transform" :class="active === {{ $i }} && 'rotate-45'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                        <div x-show="active === {{ $i }}" x-transition class="px-6 pb-4 text-sm text-ink/70">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-layouts.app>
