<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string|\UnitEnum|null $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 2;
    protected static ?string $label = 'Pengaturan';
    protected static ?string $pluralLabel = 'Pengaturan Sistem';

    public static function canViewAny(): bool
    {
        return auth()->user()?->isBph() ?? false;
    }

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('key')
                ->label('Kunci (key)')
                ->required()
                ->unique(ignoreRecord: true)
                ->helperText('Contoh: store_page_text, contact_whatsapp'),
            Select::make('group')
                ->label('Grup')
                ->options([
                    'general' => 'Umum',
                    'store'   => 'Toko / Store',
                    'contact' => 'Kontak',
                    'social'  => 'Media Sosial',
                ])
                ->default('general')
                ->required(),
            Textarea::make('value')
                ->label('Nilai')
                ->rows(5)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->label('Kunci')->searchable()->sortable(),
                TextColumn::make('group')->label('Grup')->badge(),
                TextColumn::make('value')->label('Nilai')->limit(80),
                TextColumn::make('updated_at')->label('Diperbarui')->dateTime()->sortable(),
            ])
            ->defaultSort('group')
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit'   => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
