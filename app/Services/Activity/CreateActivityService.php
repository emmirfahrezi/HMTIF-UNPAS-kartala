<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Http\UploadedFile;
use Mews\Purifier\Facades\Purifier;

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

        if (isset($validated['body'])) {
            $validated['body'] = Purifier::clean($validated['body']);
        }

        return Activity::create($validated);
    }
}
