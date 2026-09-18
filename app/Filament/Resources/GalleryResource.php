<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-photo';

    protected static \UnitEnum|string|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')->required()->maxLength(255),
            Select::make('category')->options([
                'interior' => 'Interior',
                'food' => 'Kuliner',
                'kitchen' => 'Dapur',
                'event' => 'Acara',
                'customer' => 'Pelanggan',
            ])->required(),
            Textarea::make('description')->rows(3)->columnSpanFull(),
            FileUpload::make('image')->image()->directory('galleries')->imageEditor()->required(),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('status')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')->square(),
            TextColumn::make('title')->searchable(),
            TextColumn::make('category')->badge(),
            ToggleColumn::make('status'),
        ])->filters([
            SelectFilter::make('category')->options([
                'interior' => 'Interior', 'food' => 'Kuliner', 'kitchen' => 'Dapur',
                'event' => 'Acara', 'customer' => 'Pelanggan',
            ]),
        ])->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
