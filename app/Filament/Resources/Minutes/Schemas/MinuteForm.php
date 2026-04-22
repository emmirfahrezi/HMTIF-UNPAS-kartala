<?php

namespace App\Filament\Resources\Minutes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class MinuteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomor')
                    ->label('Nomor')
                    ->required()
                    ->placeholder('001/HMTIF/IV/2026'),
                TextInput::make('perihal')
                    ->label('Perihal')
                    ->required(),
                DatePicker::make('tanggal')
                    ->label('Hari / Tanggal')
                    ->required(),
                TimePicker::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->required()
                    ->seconds(false),
                TimePicker::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->seconds(false),
                TextInput::make('tempat')
                    ->label('Tempat')
                    ->required(),
                TextInput::make('dipimpin_oleh')
                    ->label('Dipimpin Oleh')
                    ->required(),
                Textarea::make('agenda')
                    ->label('Agenda Rapat')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                RichEditor::make('isi_rapat')
                    ->label('Isi Rapat / Hasil Rapat')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('dokumentasi_file')
                    ->label('Dokumentasi File (PDF / Gambar)')
                    ->directory('minutes/files')
                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                    ->maxSize(20480)
                    ->columnSpanFull(),
                Repeater::make('attendees')
                    ->label('Daftar Hadir')
                    ->relationship('attendees')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required(),
                        TextInput::make('nim')
                            ->label('NIM')
                            ->maxLength(20),
                        TextInput::make('jabatan')
                            ->label('Jabatan'),
                        ToggleButtons::make('keterangan')
                            ->label('Keterangan')
                            ->options([
                                'hadir' => 'Hadir',
                                'izin'  => 'Izin',
                                'alpha' => 'Alpha',
                            ])
                            ->colors([
                                'hadir' => 'success',
                                'izin'  => 'warning',
                                'alpha' => 'danger',
                            ])
                            ->inline()
                            ->default('hadir'),
                        FileUpload::make('paraf')
                            ->label('Paraf')
                            ->directory('minutes/paraf')
                            ->image()
                            ->maxSize(2048),
                        TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->hidden(),
                    ])
                    ->defaultItems(0)
                    ->reorderableWithDragAndDrop()
                    ->columnSpanFull()
                    ->columns(2),
            ]);
    }
}
