@props(['dark' => false])

@php
    $logoExists = file_exists(public_path('images/logo.png'));
@endphp

@if ($logoExists)
    <img src="{{ asset('images/logo.png') }}" alt="Selera Nusantara" {{ $attributes->merge(['class' => 'h-10 w-auto object-contain']) }}>
@else
    <span {{ $attributes->merge(['class' => 'font-heading text-2xl font-extrabold tracking-tight']) }}
          style="color: {{ $dark ? '#FFFFFF' : '#A80707' }}">
        Selera <span class="font-light">Nusantara</span>
    </span>
@endif
