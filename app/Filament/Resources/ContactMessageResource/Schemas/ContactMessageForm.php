<?php

namespace App\Filament\Resources\ContactMessageResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required()->disabled(),
            TextInput::make('email')->required()->disabled(),
            TextInput::make('subject')->disabled(),
            Textarea::make('message')->rows(5)->disabled()->columnSpanFull(),
            Select::make('status')->options([
                'unread' => 'Belum Dibaca',
                'read' => 'Sudah Dibaca',
                'replied' => 'Sudah Dibalas',
            ])->default('unread')->required(),
        ]);
    }
}
