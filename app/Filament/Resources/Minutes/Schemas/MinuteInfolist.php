<?php

namespace App\Filament\Resources\Minutes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MinuteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nomor'),
                TextEntry::make('perihal'),
                TextEntry::make('tanggal')
                    ->date(),
                TextEntry::make('waktu_mulai')
                    ->time(),
                TextEntry::make('waktu_selesai')
                    ->time()
                    ->placeholder('-'),
                TextEntry::make('tempat'),
                TextEntry::make('dipimpin_oleh'),
                TextEntry::make('agenda')
                    ->columnSpanFull(),
                TextEntry::make('isi_rapat')
                    ->columnSpanFull(),
                TextEntry::make('dokumentasi_file')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
