<?php

namespace App\Filament\Resources\Minutes;

use App\Filament\Resources\Minutes\Pages\CreateMinute;
use App\Filament\Resources\Minutes\Pages\EditMinute;
use App\Filament\Resources\Minutes\Pages\ListMinutes;
use App\Filament\Resources\Minutes\Pages\ViewMinute;
use App\Filament\Resources\Minutes\Schemas\MinuteForm;
use App\Filament\Resources\Minutes\Schemas\MinuteInfolist;
use App\Filament\Resources\Minutes\Tables\MinutesTable;
use App\Models\Minute;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class MinuteResource extends Resource
{
    protected static ?string $model = Minute::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static string|\UnitEnum|null $navigationGroup = 'Rapat';
    protected static ?string $label = 'Notulensi';
    protected static ?string $pluralLabel = 'Notulensi Rapat';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return auth()->user()?->isKoordinator() ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return MinuteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MinuteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MinutesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMinutes::route('/'),
            'create' => CreateMinute::route('/create'),
            'view' => ViewMinute::route('/{record}'),
            'edit' => EditMinute::route('/{record}/edit'),
        ];
    }
}
