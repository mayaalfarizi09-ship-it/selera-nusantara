<?php

namespace App\Filament\Resources\MenuResource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('category_id')
                ->relationship('category', 'name', fn ($query) => $query->withoutGlobalScopes())
                ->required()
                ->searchable()
                ->preload(),
            TextInput::make('name')->required()->maxLength(255)->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
            TextInput::make('price')->numeric()->prefix('Rp')->required(),
            TextInput::make('rating')->numeric()->step(0.1)->minValue(0)->maxValue(5)->default(5),
            RichEditor::make('description')->columnSpanFull(),
            FileUpload::make('image')->image()->directory('menus')->disk('public')->imageEditor(),
            Toggle::make('featured')->label('Menu Unggulan'),
            Toggle::make('status')->default(true)->label('Aktif'),
        ]);
    }
}
