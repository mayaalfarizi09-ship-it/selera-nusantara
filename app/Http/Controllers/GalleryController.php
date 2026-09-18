<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $galleries = Gallery::active()
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->category))
            ->orderBy('sort_order')
            ->paginate(12)
            ->withQueryString();

        $categories = [
            'interior' => 'Interior',
            'food' => 'Kuliner',
            'kitchen' => 'Dapur',
            'event' => 'Acara',
            'customer' => 'Pelanggan',
        ];

        return view('pages.gallery.index', compact('galleries', 'categories'));
    }
}
