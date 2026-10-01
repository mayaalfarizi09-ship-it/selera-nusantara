<?php

namespace App\Filament\Resources\TeamResource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required()->maxLength(255),
            TextInput::make('position')->required()->maxLength(255)
                ->helperText('Contoh: Owner, Executive Chef, Restaurant Manager, Cashier, Waiter, Customer Service'),
            FileUpload::make('photo')->image()->directory('team')->disk('public')->imageEditor(),
            Textarea::make('description')->rows(3)->columnSpanFull(),
            TextInput::make('instagram')->prefix('@'),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('status')->default(true),
        ]);
    }
}
