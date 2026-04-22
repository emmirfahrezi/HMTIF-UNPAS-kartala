<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-calendar';
    protected static string|\UnitEnum|null $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 1;
    protected static ?string $label = 'Kegiatan';
    protected static ?string $pluralLabel = 'Kegiatan';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            RichEditor::make('description')->required()->columnSpanFull(),
            RichEditor::make('body')->columnSpanFull(),
            TextInput::make('thumbnail')->label('URL Thumbnail'),
            FileUpload::make('file')
                ->label('File Lampiran (PDF/Dokumen)')
                ->directory('activities/files')
                ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->maxSize(10240),
            DateTimePicker::make('start_date')->required(),
            DateTimePicker::make('end_date'),
            TextInput::make('location'),
            TextInput::make('registration_url')->url(),
            Select::make('status')
                ->options(['upcoming' => 'Upcoming', 'ongoing' => 'Ongoing', 'past' => 'Past'])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('status')->badge()
                    ->color(fn ($state) => match ($state) {
                        'upcoming' => 'info',
                        'ongoing'  => 'success',
                        'past'     => 'gray',
                    }),
                TextColumn::make('start_date')->dateTime()->sortable(),
                TextColumn::make('location'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(['upcoming' => 'Upcoming', 'ongoing' => 'Ongoing', 'past' => 'Past']),
            ])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit'   => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
