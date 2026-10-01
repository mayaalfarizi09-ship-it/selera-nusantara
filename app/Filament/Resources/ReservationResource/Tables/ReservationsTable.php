<?php

namespace App\Filament\Resources\ReservationResource\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReservationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('phone'),
                TextColumn::make('guest')->label('Tamu'),
                TextColumn::make('reservation_date')->date()->sortable(),
                TextColumn::make('reservation_time')->time(),
                TextColumn::make('status')->badge()->colors([
                    'warning' => 'pending',
                    'success' => 'confirmed',
                    'danger' => 'cancelled',
                    'gray' => 'completed',
                ]),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'pending' => 'Pending', 'confirmed' => 'Confirmed',
                    'cancelled' => 'Cancelled', 'completed' => 'Completed',
                ]),
            ])
            ->defaultSort('reservation_date', 'desc');
    }
}
