<?php

namespace App\Filament\Resources\TestimonialResource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required()->maxLength(255),
            FileUpload::make('photo')->image()->directory('testimonials')->disk('public')->imageEditor(),
            Select::make('rating')->options([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'])->default(5)->required(),
            Textarea::make('message')->rows(4)->required()->columnSpanFull(),
            Toggle::make('status')->default(true),
        ]);
    }
}
