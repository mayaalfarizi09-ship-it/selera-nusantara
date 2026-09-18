<?php

namespace App\Filament\Exports;

use App\Models\Menu;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MenuExporter extends Exporter
{
    protected static ?string $model = Menu::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name'),
            ExportColumn::make('category.name')->label('Category'),
            ExportColumn::make('price'),
            ExportColumn::make('rating'),
            ExportColumn::make('featured'),
            ExportColumn::make('status'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Export menu selesai: ' . number_format($export->successful_rows) . ' baris berhasil diexport.';

        if ($failed = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failed) . ' baris gagal diexport.';
        }

        return $body;
    }
}
