<?php

namespace App\Services\Announcement;

use App\Models\Announcement;
use Illuminate\Http\UploadedFile;

class CreateAnnouncementService
{
    public function execute(array $validated, ?UploadedFile $file = null): Announcement
    {
        if ($file) {
            $validated['file'] = $file->store('announcements/files', 'public');
        }

        return Announcement::create($validated);
    }
}
