<?php

namespace App\Filament\Widgets;

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
                ->description('Menu aktif di website')
                ->color('success')
                ->icon('heroicon-o-cake'),

            Stat::make('Reservasi Pending', Reservation::where('status', 'pending')->count())
                ->description('Menunggu konfirmasi')
                ->color('warning')
                ->icon('heroicon-o-calendar-days'),

            Stat::make('Pesan Belum Dibaca', ContactMessage::where('is_read', false)->count())
                ->description('Pesan masuk baru')
                ->color('danger')
                ->icon('heroicon-o-envelope'),

            Stat::make('Testimoni', Testimonial::count())
                ->description('Total ulasan pelanggan')
                ->color('info')
                ->icon('heroicon-o-star'),
        ];
    }
}
