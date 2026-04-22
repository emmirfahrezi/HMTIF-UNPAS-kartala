<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Models\Division;
use App\Models\Staff;
use App\Models\User;
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

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-users';
    protected static string|\UnitEnum|null $navigationGroup = 'Organisasi';
    protected static ?int $navigationSort = 1;
    protected static ?string $label = 'Pengurus';
    protected static ?string $pluralLabel = 'Pengurus';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('name')->required(),
            TextInput::make('position')->required(),
            Select::make('division_id')
                ->label('Divisi')
                ->options(Division::pluck('name', 'id'))
                ->required(),
            Select::make('user_id')
                ->label('Akun Login')
                ->options(User::whereNull('staff_id')->orWhereColumn('id', 'staff_id')->pluck('email', 'id'))
                ->searchable()
                ->nullable()
                ->helperText('Hubungkan pengurus ini dengan akun login yang sudah ada'),
            TextInput::make('photo')->label('URL Foto'),
            Textarea::make('bio')->rows(3),
            TextInput::make('instagram'),
            TextInput::make('linkedin'),
            TextInput::make('order')->numeric()->default(0),
            Toggle::make('is_active')->default(true),
            Toggle::make('is_bph')->label('BPH'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('position'),
                TextColumn::make('division.name')->label('Divisi'),
                IconColumn::make('is_bph')->label('BPH')->boolean(),
                IconColumn::make('is_active')->label('Aktif')->boolean(),
                TextColumn::make('order')->sortable(),
            ])
            ->filters([
                SelectFilter::make('division_id')
                    ->label('Divisi')
                    ->relationship('division', 'name'),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListStaffs::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit'   => Pages\EditStaff::route('/{record}/edit'),
        ];
    }
}
