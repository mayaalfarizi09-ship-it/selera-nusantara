<?php

namespace App\Filament\Resources\ContactMessageResource\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')->badge()->colors([
                    'danger' => 'unread',
                    'warning' => 'read',
                    'success' => 'replied',
                ]),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('subject'),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'unread' => 'Belum Dibaca',
                    'read' => 'Sudah Dibaca',
                    'replied' => 'Sudah Dibalas',
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
