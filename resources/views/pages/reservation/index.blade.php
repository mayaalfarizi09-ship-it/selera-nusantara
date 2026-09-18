<x-layouts.app :title="'Reservasi — Selera Nusantara'">

    <section class="relative flex h-[40vh] min-h-[280px] items-center justify-center overflow-hidden bg-ink">
        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2000&auto=format&fit=crop" alt="Reservasi Selera Nusantara" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative text-center text-white" data-aos="fade-up">
            <h1 class="font-heading text-4xl font-bold sm:text-5xl">Reservasi Meja</h1>
            <p class="mt-3 text-white/80">Beranda / Reservasi</p>
        </div>
    </section>

    <section class="mx-auto max-w-2xl px-6 py-24 lg:px-8">
        @if (session('success'))
            <div class="mb-8 rounded-xl bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('reservation.store') }}" class="space-y-5 rounded-2xl border border-border p-8 shadow-sm" data-aos="fade-up">
            @csrf
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">No. Telepon / WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                           class="w-full rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium">Email (opsional)</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
            </div>

            <div class="grid gap-5 sm:grid-cols-3">
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Jumlah Tamu</label>
                    <input type="number" name="guest" min="1" value="{{ old('guest', 2) }}" required
                           class="w-full rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    @error('guest') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Tanggal</label>
                    <input type="date" name="reservation_date" value="{{ old('reservation_date') }}" min="{{ date('Y-m-d') }}" required
                           class="w-full rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    @error('reservation_date') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Jam</label>
                    <input type="time" name="reservation_time" value="{{ old('reservation_time') }}" required
                           class="w-full rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    @error('reservation_time') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium">Catatan Tambahan (opsional)</label>
                <textarea name="message" rows="3"
                          class="w-full rounded-xl border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="btn-primary ripple w-full">Kirim Reservasi</button>
        </form>
    </section>

</x-layouts.app>
