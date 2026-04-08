<?php

namespace App\Services\Announcement;

use App\Models\AnnouncementCategory;
use Illuminate\Database\Eloquent\Collection;

class GetAnnouncementCategoriesService
{
    public function execute(): Collection
    {
        return AnnouncementCategory::withCount('announcements')->get();
    }
}
