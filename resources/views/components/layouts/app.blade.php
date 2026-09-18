<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Selera Nusantara — Restoran Nusantara Premium' }}</title>
    <meta name="description" content="{{ $description ?? 'Selera Nusantara menghadirkan cita rasa autentik nusantara dalam balutan pengalaman bersantap premium.' }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $title ?? 'Selera Nusantara' }}">
    <meta property="og:description" content="{{ $description ?? 'Cita Rasa Nusantara dalam Setiap Sajian' }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('images/og-cover.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" href="{{ file_exists(public_path('images/logo.png')) ? asset('images/logo.png') : asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-ink">

    {{-- Loading Screen --}}
    <div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 500)" x-show="loading"
         x-transition:leave="transition ease-in duration-400" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-white">
        <x-logo class="h-10 w-auto animate-pulse" />
    </div>

    <x-navbar />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    {{-- Floating WhatsApp / Reservation shortcut --}}
    <a href="https://wa.me/{{ \App\Models\Setting::current()->whatsapp ?? '6281234567890' }}" target="_blank" rel="noopener"
       class="fixed bottom-6 right-6 z-40 flex items-center gap-2 rounded-full bg-primary px-5 py-3 text-white shadow-xl shadow-primary/30 transition-transform hover:scale-105">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.6 6.32A7.85 7.85 0 0 0 12.05 4a7.94 7.94 0 0 0-6.9 11.9L4 20l4.2-1.1a7.9 7.9 0 0 0 3.85 1h.01a7.94 7.94 0 0 0 5.54-13.58ZM12.06 18.4a6.6 6.6 0 0 1-3.36-.92l-.24-.14-2.5.65.67-2.44-.16-.25a6.6 6.6 0 1 1 5.6 3.1Zm3.6-4.94c-.2-.1-1.17-.58-1.35-.64-.18-.07-.31-.1-.44.1-.13.2-.5.64-.62.77-.11.13-.23.15-.42.05-.2-.1-.83-.31-1.58-.98-.58-.52-.98-1.16-1.09-1.36-.11-.2-.01-.3.09-.4.09-.1.2-.23.3-.35.1-.12.13-.2.2-.33.07-.13.03-.25-.02-.35-.05-.1-.44-1.07-.6-1.46-.16-.38-.32-.33-.44-.33-.11 0-.24-.01-.37-.01-.13 0-.35.05-.53.25-.18.2-.7.68-.7 1.66 0 .98.72 1.93.82 2.06.1.13 1.4 2.15 3.4 3.01.48.2.85.33 1.14.42.48.15.91.13 1.26.08.38-.06 1.17-.48 1.34-.94.16-.46.16-.86.11-.94-.05-.08-.18-.13-.38-.23Z"/></svg>
        <span class="hidden font-heading text-sm font-semibold sm:inline">Reservasi</span>
    </a>

</body>
</html>
