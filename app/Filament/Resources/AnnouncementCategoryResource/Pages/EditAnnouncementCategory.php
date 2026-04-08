<?php

namespace App\Filament\Resources\AnnouncementCategoryResource\Pages;

use App\Filament\Resources\AnnouncementCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAnnouncementCategory extends EditRecord
{
    protected static string $resource = AnnouncementCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
