<?php

namespace App\Services\Staff;

use App\Models\Staff;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateStaffService
{
    public function execute(Staff $staff, array $validated, ?UploadedFile $photoFile = null): Staff
    {
        $validated['is_active'] = isset($validated['is_active']) && $validated['is_active'];
        $validated['is_bph']    = isset($validated['is_bph']) && $validated['is_bph'];

        // Perbarui foto lokal — hapus lama jika bukan URL eksternal
        if ($photoFile) {
            $this->deleteLocalFile($staff->photo);
            $validated['photo'] = $photoFile->store('staffs/photos', 'public');
        }

        // Buang key photo_file agar tidak masuk ke DB
        unset($validated['photo_file']);

        $staff->update($validated);

        return $staff;
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
