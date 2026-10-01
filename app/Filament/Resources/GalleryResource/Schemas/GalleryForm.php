<?php

namespace App\Filament\Resources\GalleryResource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
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
            FileUpload::make('image')->image()->directory('galleries')->disk('public')->imageEditor()->required(),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('status')->default(true),
        ]);
    }
}
