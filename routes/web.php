<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Selera Nusantara
|--------------------------------------------------------------------------
| Every navigation menu opens a separate page (no one-page scrolling).
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{menu:slug}', [MenuController::class, 'show'])->name('menu.show');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/team', [TeamController::class, 'index'])->name('team');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
