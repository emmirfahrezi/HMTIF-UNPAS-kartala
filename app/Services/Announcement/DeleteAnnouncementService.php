<?php

namespace App\Services\Announcement;

use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;

class DeleteAnnouncementService
{
    public function execute(Announcement $announcement): void
    {
        if ($announcement->file) {
            Storage::disk('public')->delete($announcement->file);
        }

        $announcement->delete();
    }
}
