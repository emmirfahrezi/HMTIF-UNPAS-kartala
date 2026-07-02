<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;

class UpdateActivityService
{
    public function execute(
        Activity $activity,
        array $validated,
        ?UploadedFile $file = null,
        ?UploadedFile $thumbnailFile = null,
    ): Activity {
        // Perbarui file dokumen lampiran
        if ($file) {
            if ($activity->file) {
                Storage::disk('public')->delete($activity->file);
            }
            $validated['file'] = $file->store('activities/files', 'public');
        }

        // Perbarui thumbnail lokal — hapus lama jika bukan URL eksternal
        if ($thumbnailFile) {
            $this->deleteLocalFile($activity->thumbnail);
            $validated['thumbnail'] = $thumbnailFile->store('activities/thumbnails', 'public');
        }

        // Buang key thumbnail_file agar tidak masuk ke DB
        unset($validated['thumbnail_file']);

        if (isset($validated['body'])) {
            $validated['body'] = Purifier::clean($validated['body']);
        }

        $activity->update($validated);

        return $activity;
    }

    /**
     * Hapus file dari storage lokal.
     * Tidak menghapus jika path adalah URL eksternal.
     */
    private function deleteLocalFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}
