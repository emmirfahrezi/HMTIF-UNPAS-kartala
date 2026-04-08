<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatResource\Pages;
use App\Models\Stat;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatResource extends Resource
{
    protected static ?string $model = Stat::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static string|\UnitEnum|null $navigationGroup = 'Organisasi';
    protected static ?int $navigationSort = 3;
    protected static ?string $label = 'Statistik';
    protected static ?string $pluralLabel = 'Statistik';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('label')->required(),
            TextInput::make('value')->required(),
            TextInput::make('icon'),
            TextInput::make('order')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label'),
                TextColumn::make('value'),
                TextColumn::make('icon'),
                TextColumn::make('order')->sortable(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListStats::route('/'),
            'create' => Pages\CreateStat::route('/create'),
            'edit'   => Pages\EditStat::route('/{record}/edit'),
        ];
    }
}
