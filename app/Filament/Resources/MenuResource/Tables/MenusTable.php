<?php

namespace App\Filament\Resources\MenuResource\Tables;

use App\Filament\Exports\MenuExporter;
use App\Filament\Imports\MenuImporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class MenusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->disk('public')->checkFileExistence(false)->square(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name')->badge()->sortable(),
                TextColumn::make('price')->money('IDR')->sortable(),
                TextColumn::make('rating')->sortable(),
                IconColumn::make('featured')->boolean(),
                IconColumn::make('status')->boolean(),
            ])
            ->filters([
                SelectFilter::make('category_id')->relationship('category', 'name')->label('Kategori'),
                TernaryFilter::make('featured'),
                TernaryFilter::make('status'),
            ])
            ->headerActions([
                ImportAction::make()->importer(MenuImporter::class),
                ExportAction::make()->exporter(MenuExporter::class),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
