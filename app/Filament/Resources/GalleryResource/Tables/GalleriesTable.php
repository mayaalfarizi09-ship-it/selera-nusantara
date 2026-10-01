<?php

namespace App\Filament\Resources\GalleryResource\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->square(),
                TextColumn::make('title')->searchable(),
                TextColumn::make('category')->badge(),
                ToggleColumn::make('status'),
            ])
            ->filters([
                SelectFilter::make('category')->options([
                    'interior' => 'Interior', 'food' => 'Kuliner', 'kitchen' => 'Dapur',
                    'event' => 'Acara', 'customer' => 'Pelanggan',
                ]),
            ])
            ->reorderable('sort_order');
    }
}
