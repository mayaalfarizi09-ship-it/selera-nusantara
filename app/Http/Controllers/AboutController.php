<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class AboutController extends Controller
{
    public function index()
    {
        $settings = Setting::current();

        $timeline = [
            ['year' => '2012', 'title' => 'Awal Mula', 'text' => 'Selera Nusantara dirintis dari dapur kecil dengan resep warisan keluarga.'],
            ['year' => '2016', 'title' => 'Restoran Pertama', 'text' => 'Membuka gerai pertama dan mulai dikenal luas oleh pecinta kuliner nusantara.'],
            ['year' => '2020', 'title' => 'Ekspansi', 'text' => 'Menghadirkan konsep premium dining dengan suasana yang lebih elegan.'],
            ['year' => '2024', 'title' => 'Selera Nusantara Kini', 'text' => 'Menjadi destinasi kuliner nusantara premium pilihan keluarga modern.'],
        ];

        return view('pages.about.index', compact('settings', 'timeline'));
    }
}
