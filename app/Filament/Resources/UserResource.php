<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\Staff;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-lock-closed';
    protected static string|\UnitEnum|null $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 1;
    protected static ?string $label = 'Akun';
    protected static ?string $pluralLabel = 'Manajemen Akun';

    public static function canViewAny(): bool
    {
        return auth()->user()?->isBph() ?? false;
    }

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nama')
                ->required(),
            TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),
            TextInput::make('password')
                ->password()
                ->revealable()
                ->nullable()
                ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                ->dehydrated(fn ($state) => filled($state))
                ->helperText('Kosongkan jika tidak ingin mengubah password'),
            Select::make('role')
                ->label('Role / Hak Akses')
                ->options([
                    'admin'       => 'Admin',
                    'bph'         => 'BPH (Akses Penuh)',
                    'koordinator' => 'Koordinator (Data Pengurus + Notulensi)',
                    'staff'       => 'Staff (Akses Terbatas)',
                ])
                ->required()
                ->default('staff'),
            Select::make('staff_id')
                ->label('Pengurus Terkait')
                ->options(Staff::where('is_active', true)->pluck('name', 'id'))
                ->searchable()
                ->nullable()
                ->helperText('Hubungkan akun ini dengan data pengurus'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role')->label('Role')->badge()
                    ->color(fn ($state) => match ($state) {
                        'admin'       => 'danger',
                        'bph'         => 'warning',
                        'koordinator' => 'info',
                        'staff'       => 'gray',
                    }),
                TextColumn::make('staff.name')->label('Pengurus')->placeholder('-'),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
