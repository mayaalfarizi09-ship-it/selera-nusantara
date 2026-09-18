<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Category;
use App\Models\Menu;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cake';

    protected static \UnitEnum|string|null $navigationGroup = 'Menu Management';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('category_id')
                ->relationship('category', 'name', fn ($query) => $query->withoutGlobalScopes())
                ->required()
                ->searchable()
                ->preload(),
            TextInput::make('name')->required()->maxLength(255)->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
            TextInput::make('price')->numeric()->prefix('Rp')->required(),
            TextInput::make('rating')->numeric()->step(0.1)->minValue(0)->maxValue(5)->default(5),
            RichEditor::make('description')->columnSpanFull(),
            FileUpload::make('image')->image()->directory('menus')->disk('public')->imageEditor(),
            Toggle::make('featured')->label('Menu Unggulan'),
            Toggle::make('status')->default(true)->label('Aktif'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->disk('public')->checkFileExistence(false)->square(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name')->badge()->sortable(),
                TextColumn::make('price')->money('IDR')->sortable(),
                TextColumn::make('rating')->sortable(),
                IconColumn::make('featured')->boolean(),
                IconColumn::make('status')->boolean(),
            ])
            ->filters([
                SelectFilter::make('category_id')->relationship('category', 'name')->label('Kategori'),
                TernaryFilter::make('featured'),
                TernaryFilter::make('status'),
            ])
            ->headerActions([
                ImportAction::make()->importer(\App\Filament\Imports\MenuImporter::class),
                ExportAction::make()->exporter(\App\Filament\Exports\MenuExporter::class),
            ])
            ->defaultSort('created_at', 'desc');
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
