<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Testimonial;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Menu', Menu::count())
                ->description('Seluruh menu terdaftar')
                ->color('success')
                ->icon('heroicon-o-cake'),

            Stat::make('Total Kategori', Category::count())
                ->description('Kategori makanan/minuman')
                ->color('info')
                ->icon('heroicon-o-tag'),

            Stat::make('Total Reservasi', Reservation::count())
                ->description('Seluruh reservasi pelanggan')
                ->color('primary')
                ->icon('heroicon-o-calendar-days'),

            Stat::make('Reservasi Pending', Reservation::where('status', 'pending')->count())
                ->description('Menunggu konfirmasi')
                ->color('warning')
                ->icon('heroicon-o-clock'),

            Stat::make('Total Pesan', ContactMessage::count())
                ->description(ContactMessage::where('status', 'unread')->count().' belum dibaca')
                ->color('danger')
                ->icon('heroicon-o-envelope'),

            Stat::make('Total Testimonial', Testimonial::count())
                ->description('Ulasan pelanggan')
                ->color('gray')
                ->icon('heroicon-o-star'),
        ];
    }
}
