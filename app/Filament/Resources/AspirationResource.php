<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AspirationResource\Pages;
use App\Models\Aspiration;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AspirationResource extends Resource
{
    protected static ?string $model = Aspiration::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static string|\UnitEnum|null $navigationGroup = 'Aspirasi';
    protected static ?int $navigationSort = 1;
    protected static ?string $label = 'Aspirasi';
    protected static ?string $pluralLabel = 'Aspirasi';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('name')->label('Nama')->nullable(),
            TextInput::make('email')->email()->nullable(),
            TextInput::make('subject')->required()->label('Subjek')->columnSpanFull(),
            Textarea::make('message')->required()->rows(5)->label('Pesan')->columnSpanFull(),
            TextInput::make('tracking_code')->disabled(),
            Select::make('status')
                ->options(['pending' => 'Pending', 'reviewed' => 'Reviewed', 'resolved' => 'Resolved'])
                ->required(),
            Toggle::make('is_spotlight')->label('Spotlight Minggu Ini'),
            DatePicker::make('spotlighted_week')->label('Minggu Spotlight'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject')->searchable()->limit(40),
                TextColumn::make('name')->label('Nama'),
                TextColumn::make('tracking_code'),
                TextColumn::make('status')->badge()
                    ->color(fn ($state) => match ($state) {
                        'pending'  => 'warning',
                        'reviewed' => 'info',
                        'resolved' => 'success',
                    }),
                IconColumn::make('is_spotlight')->label('Spotlight')->boolean(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(['pending' => 'Pending', 'reviewed' => 'Reviewed', 'resolved' => 'Resolved']),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAspirations::route('/'),
            'edit'   => Pages\EditAspiration::route('/{record}/edit'),
        ];
    }
}
