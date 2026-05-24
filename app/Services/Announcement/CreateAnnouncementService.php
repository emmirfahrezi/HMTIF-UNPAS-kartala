<?php

namespace App\Services\Announcement;

use App\Models\Announcement;
use Illuminate\Http\UploadedFile;

class CreateAnnouncementService
{
    public function execute(
        array $validated,
        ?UploadedFile $file = null,
        ?UploadedFile $thumbnailFile = null,
    ): Announcement {
        // Simpan file dokumen lampiran
        if ($file) {
            $validated['file'] = $file->store('announcements/files', 'public');
        }

        // Simpan thumbnail lokal — menimpa URL thumbnail jika ada
        if ($thumbnailFile) {
            $validated['thumbnail'] = $thumbnailFile->store('announcements/thumbnails', 'public');
        }

        // Buang key thumbnail_file agar tidak masuk ke DB
        unset($validated['thumbnail_file']);

        return Announcement::create($validated);
    }
}
