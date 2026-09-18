<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static \UnitEnum|string|null $navigationGroup = 'Settings';

    protected string $view = 'filament.pages.settings-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Setting::current()->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Informasi Restoran')->schema([
                TextInput::make('restaurant_name')->required(),
                TextInput::make('tagline'),
                FileUpload::make('logo')->image()->directory('settings'),
                FileUpload::make('favicon')->image()->directory('settings'),
            ])->columns(2),
            Section::make('Kontak')->schema([
                Textarea::make('address')->rows(2),
                TextInput::make('phone'),
                TextInput::make('whatsapp'),
                TextInput::make('email')->email(),
            ])->columns(2),
            Section::make('Media Sosial')->schema([
                TextInput::make('instagram'),
                TextInput::make('facebook'),
                TextInput::make('youtube'),
                TextInput::make('tiktok'),
            ])->columns(2),
            Section::make('Jam Operasional')->schema([
                KeyValue::make('opening_hours')->keyLabel('Hari')->valueLabel('Jam'),
            ]),
            Section::make('Peta & SEO')->schema([
                Textarea::make('google_maps_embed')->rows(2),
                TextInput::make('meta_title'),
                Textarea::make('meta_description')->rows(2),
            ]),
        ])->statePath('data');
    }

    public function save(): void
    {
        Setting::current()->update($this->form->getState());

        Notification::make()->title('Pengaturan berhasil disimpan')->success()->send();
    }
}
