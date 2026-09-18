@php
    $settings = \App\Models\Setting::current();
@endphp

<footer class="bg-[#181111] pt-16 text-white/80">
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-6 pb-12 md:grid-cols-2 lg:grid-cols-4 lg:px-8">

        <div>
            <x-logo dark class="mb-4" />
            <p class="text-sm leading-relaxed text-white/60">
                {{ $settings->tagline ?? 'Cita Rasa Nusantara dalam Setiap Sajian' }}
            </p>
            <div class="mt-5 flex gap-3">
                @php
                    $socials = [
                        'instagram' => 'M12 2.2c3.2 0 3.6 0 4.9.07 3.3.15 4.8 1.7 5 5 .06 1.3.07 1.6.07 4.9s0 3.6-.07 4.9c-.15 3.3-1.7 4.8-5 5-1.3.06-1.6.07-4.9.07s-3.6 0-4.9-.07c-3.3-.15-4.8-1.7-5-5C2.06 15.6 2.05 15.3 2.05 12s0-3.6.07-4.9c.15-3.3 1.7-4.8 5-5C8.4 2.2 8.7 2.2 12 2.2Zm0 3.4a6.4 6.4 0 1 0 0 12.8 6.4 6.4 0 0 0 0-12.8Zm0 10.6a4.2 4.2 0 1 1 0-8.4 4.2 4.2 0 0 1 0 8.4Zm6.6-10.8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z',
                        'facebook' => 'M13.5 21v-8h2.7l.4-3.1h-3.1V8c0-.9.25-1.5 1.55-1.5H16.7V3.7c-.28-.04-1.25-.12-2.38-.12-2.36 0-3.97 1.44-3.97 4.1V10H7.6v3.1h2.75V21h3.15Z',
                        'youtube' => 'M21.6 7.2c-.2-1.4-.9-2.3-2.3-2.5C17 4.3 12 4.3 12 4.3s-5 0-7.3.4c-1.4.2-2.1 1.1-2.3 2.5C2.1 8.9 2.1 12 2.1 12s0 3.1.3 4.8c.2 1.4.9 2.3 2.3 2.5 2.3.4 7.3.4 7.3.4s5 0 7.3-.4c1.4-.2 2.1-1.1 2.3-2.5.3-1.7.3-4.8.3-4.8s0-3.1-.3-4.8ZM9.9 15.2V8.8L15.5 12l-5.6 3.2Z',
                    ];
                @endphp
                @foreach ($socials as $key => $path)
                    @if ($settings->$key)
                        <a href="https://{{ $key }}.com/{{ $settings->$key }}" target="_blank" rel="noopener"
                           class="flex h-9 w-9 items-center justify-center rounded-full border border-white/20 transition-colors hover:border-primary hover:bg-primary">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="{{ $path }}"/></svg>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <div>
            <h4 class="mb-4 font-heading text-sm font-semibold uppercase tracking-wide text-white">Tautan Cepat</h4>
            <ul class="space-y-3 text-sm">
                <li><a href="{{ route('about') }}" class="hover:text-primary">Tentang Kami</a></li>
                <li><a href="{{ route('menu.index') }}" class="hover:text-primary">Menu</a></li>
                <li><a href="{{ route('gallery') }}" class="hover:text-primary">Galeri</a></li>
                <li><a href="{{ route('team') }}" class="hover:text-primary">Tim Kami</a></li>
                <li><a href="{{ route('reservation.index') }}" class="hover:text-primary">Reservasi</a></li>
            </ul>
        </div>

        <div>
            <h4 class="mb-4 font-heading text-sm font-semibold uppercase tracking-wide text-white">Alamat</h4>
            <p class="text-sm leading-relaxed text-white/60">{{ $settings->address ?? 'Jl. Radio Dalam No. 88, Jakarta Selatan, kecamatan kebayoran lama' }}</p>
            <p class="mt-3 text-sm text-white/60">{{ $settings->phone ?? '(+62) 856 - 9266 - 6575 ' }}</p>
            <p class="text-sm text-white/60">{{ $settings->email ?? 'info@selera-nusantara.test' }}</p>
        </div>

        <div>
            <h4 class="mb-4 font-heading text-sm font-semibold uppercase tracking-wide text-white">Jam Operasional</h4>
            <ul class="space-y-2 text-sm text-white/60">
                @forelse ($settings->opening_hours ?? [] as $day => $hours)
                    <li class="flex justify-between gap-4"><span>{{ $day }}</span><span>{{ $hours }}</span></li>
                @empty
                    <li class="flex justify-between gap-4"><span>Senin - Jumat</span><span>10.00 - 22.00</span></li>
                    <li class="flex justify-between gap-4"><span>Sabtu - Minggu</span><span>09.00 - 23.00</span></li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10 py-6 text-center text-xs text-white/40">
        &copy; {{ date('Y') }} Selera Nusantara. Seluruh hak cipta dilindungi.
    </div>
</footer>
