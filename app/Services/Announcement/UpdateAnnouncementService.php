<?php

namespace App\Services\Announcement;

use App\Models\Announcement;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateAnnouncementService
{
    public function execute(
        Announcement $announcement,
        array $validated,
        ?UploadedFile $file = null,
        ?UploadedFile $thumbnailFile = null,
    ): Announcement {
        // Perbarui file dokumen lampiran
        if ($file) {
            if ($announcement->file) {
                Storage::disk('public')->delete($announcement->file);
            }
            $validated['file'] = $file->store('announcements/files', 'public');
        }

        // Perbarui thumbnail lokal — hapus lama jika bukan URL eksternal
        if ($thumbnailFile) {
            $this->deleteLocalFile($announcement->thumbnail);
            $validated['thumbnail'] = $thumbnailFile->store('announcements/thumbnails', 'public');
        }

        // Buang key thumbnail_file agar tidak masuk ke DB
        unset($validated['thumbnail_file']);

        $announcement->update($validated);

        return $announcement;
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
