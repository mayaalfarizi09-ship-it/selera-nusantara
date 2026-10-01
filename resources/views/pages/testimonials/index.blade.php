<x-layouts.app :title="'Testimonial - Selera Nusantara'">

    <section class="relative flex h-[45vh] min-h-[320px] items-center justify-center overflow-hidden bg-ink">
        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2000&auto=format&fit=crop" alt="Testimonial Selera Nusantara" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative text-center text-white" data-aos="fade-up">
            <h1 class="font-heading text-4xl font-bold sm:text-5xl">Testimonial</h1>
            <p class="mt-3 text-white/80">Beranda / Testimonial</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
        <div class="mx-auto max-w-xl text-center" data-aos="fade-up">
            <span class="section-eyebrow">Cerita Pelanggan</span>
            <h2 class="section-heading">Apa Kata Mereka Tentang Kami</h2>
            <p class="mt-4 text-ink/70">Pengalaman nyata dari pelanggan yang telah menikmati cita rasa Selera Nusantara.</p>
        </div>

        <div class="mt-14 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($testimonials as $t)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 100 }}"
                     class="flex h-full flex-col rounded-2xl border border-border bg-white p-8 shadow-sm transition-shadow duration-300 hover:shadow-xl">
                    <div class="flex gap-1 text-primary">
                        @for ($i = 0; $i < $t->rating; $i++)
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09L5.5 11.545.5 7.41l6.11-.89L10 1l3.39 5.52 6.11.89-5 4.135 1.378 6.545z"/></svg>
                        @endfor
                    </div>
                    <p class="mt-4 flex-1 text-sm italic leading-relaxed text-ink/70">"{{ $t->message }}"</p>
                    <div class="mt-6 flex items-center gap-3 border-t border-border pt-5">
                        @if ($t->photo)
                            <img src="{{ asset('storage/'.$t->photo) }}" alt="{{ $t->name }}" class="h-11 w-11 rounded-full object-cover">
                        @else
                            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-primary/10 font-heading text-sm font-bold text-primary">
                                {{ strtoupper(substr($t->name, 0, 1)) }}
                            </span>
                        @endif
                        <div>
                            <p class="font-heading text-sm font-semibold">{{ $t->name }}</p>
                            <p class="text-xs text-ink/50">Pelanggan Selera Nusantara</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-ink/50">Belum ada testimonial.</p>
            @endforelse
        </div>

        <div class="mt-14">
            {{ $testimonials->links() }}
        </div>
    </section>

</x-layouts.app>
