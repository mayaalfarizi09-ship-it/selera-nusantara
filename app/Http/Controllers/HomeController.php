<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Team;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::current();
        $featuredMenus = Menu::active()->featured()->with('category')->latest()->take(6)->get();
        $categories = Category::active()->withCount('menus')->orderBy('sort_order')->take(8)->get();
        $galleries = Gallery::active()->orderBy('sort_order')->take(8)->get();
        $team = Team::active()->take(6)->get();
        $testimonials = Testimonial::active()->latest()->take(6)->get();

        $stats = [
            'years' => 12,
            'menus' => Menu::active()->count() ?: 80,
            'customers' => 25000,
            'awards' => 15,
        ];

        return view('pages.home', compact(
            'settings',
            'featuredMenus',
            'categories',
            'galleries',
            'team',
            'testimonials',
            'stats'
        ));
    }
}
