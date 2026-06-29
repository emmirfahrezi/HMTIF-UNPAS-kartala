<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Http\UploadedFile;

class CreateActivityService
{
    public function execute(
        array $validated,
        ?UploadedFile $file = null,
        ?UploadedFile $thumbnailFile = null,
    ): Activity {
        // Simpan file dokumen lampiran
        if ($file) {
            $validated['file'] = $file->store('activities/files', 'public');
        }

        // Simpan thumbnail lokal — menimpa URL thumbnail jika ada
        if ($thumbnailFile) {
            $validated['thumbnail'] = $thumbnailFile->store('activities/thumbnails', 'public');
        }

        // Buang key thumbnail_file agar tidak masuk ke DB
        unset($validated['thumbnail_file']);

        return Activity::create($validated);
    }
}
