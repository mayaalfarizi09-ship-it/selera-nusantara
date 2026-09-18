<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::active()->orderBy('sort_order')->get();

        $menus = Menu::query()
            ->active()
            ->with('category')
            ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%' . $request->q . '%'))
            ->when($request->filled('category'), fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $request->category)))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.menu.index', compact('categories', 'menus'));
    }

    public function show(Menu $menu)
    {
        $related = Menu::active()->where('category_id', $menu->category_id)->where('id', '!=', $menu->id)->take(4)->get();

        return view('pages.menu.show', compact('menu', 'related'));
    }
}
