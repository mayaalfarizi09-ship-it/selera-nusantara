<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;
use App\Models\Setting;

class ContactController extends Controller
{
    public function index()
    {
        $settings = Setting::current();

        $faqs = [
            ['q' => 'Apakah perlu reservasi terlebih dahulu?', 'a' => 'Untuk kenyamanan Anda, kami menyarankan reservasi terutama pada akhir pekan dan hari libur.'],
            ['q' => 'Apakah tersedia menu untuk acara khusus?', 'a' => 'Ya, kami menyediakan paket menu untuk acara keluarga, ulang tahun, hingga acara korporat.'],
            ['q' => 'Apakah tersedia area parkir?', 'a' => 'Tersedia area parkir yang luas dan aman untuk kendaraan roda dua maupun roda empat.'],
        ];

        return view('pages.contact.index', compact('settings', 'faqs'));
    }

    public function store(ContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());

        return back()->with('success', 'Pesan Anda berhasil terkirim. Tim kami akan segera menghubungi Anda.');
    }
}
