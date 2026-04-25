<?php

namespace App\Services\Announcement;

use App\Models\Announcement;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateAnnouncementService
{
    public function execute(Announcement $announcement, array $validated, ?UploadedFile $file = null): Announcement
    {
        if ($file) {
            if ($announcement->file) {
                Storage::disk('public')->delete($announcement->file);
            }
            $validated['file'] = $file->store('announcements/files', 'public');
        }

        $announcement->update($validated);

        return $announcement;
    }
}
