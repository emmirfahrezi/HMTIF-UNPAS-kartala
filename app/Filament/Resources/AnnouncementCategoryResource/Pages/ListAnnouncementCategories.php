<?php

namespace App\Filament\Resources\AnnouncementCategoryResource\Pages;

use App\Filament\Resources\AnnouncementCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnnouncementCategories extends ListRecords
{
    protected static string $resource = AnnouncementCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
