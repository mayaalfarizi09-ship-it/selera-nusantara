<?php

namespace App\Filament\Resources\MenuResource;

use App\Filament\Resources\MenuResource\Schemas\MenuForm;
use App\Filament\Resources\MenuResource\Tables\MenusTable;
use App\Models\Menu;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $slug = 'menus';

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cake';

    protected static \UnitEnum|string|null $navigationGroup = 'Menu Management';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return MenuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenusTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
