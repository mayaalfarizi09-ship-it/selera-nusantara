<?php

namespace App\Filament\Imports;

use App\Models\Menu;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MenuImporter extends Importer
{
    protected static ?string $model = Menu::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')->requiredMapping()->rules(['required', 'max:255']),
            ImportColumn::make('price')->requiredMapping()->numeric()->rules(['required', 'numeric']),
            ImportColumn::make('description'),
            ImportColumn::make('rating')->numeric(),
        ];
    }

    public function resolveRecord(): ?Menu
    {
        return Menu::firstOrNew(['name' => $this->data['name']]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Import menu selesai: ' . number_format($import->successful_rows) . ' baris berhasil diimport.';

        if ($failed = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failed) . ' baris gagal diimport.';
        }

        return $body;
    }
}
