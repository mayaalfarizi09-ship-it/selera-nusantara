<?php

namespace App\Filament\Resources\ReservationResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required(),
            TextInput::make('phone')->required(),
            TextInput::make('email')->email(),
            TextInput::make('guest')->numeric()->required()->label('Jumlah Tamu'),
            DatePicker::make('reservation_date')->required(),
            TimePicker::make('reservation_time')->required(),
            Textarea::make('message')->columnSpanFull(),
            Select::make('status')->options([
                'pending' => 'Pending',
                'confirmed' => 'Confirmed',
                'cancelled' => 'Cancelled',
                'completed' => 'Completed',
            ])->default('pending')->required(),
        ]);
    }
}
