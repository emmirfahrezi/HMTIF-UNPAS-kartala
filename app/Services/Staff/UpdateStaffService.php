<?php

namespace App\Services\Staff;

use App\Models\Staff;
use App\Models\StaffPeriod;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateStaffService
{
    public function execute(Staff $staff, array $validated, ?UploadedFile $photoFile = null): Staff
    {
        $validated['is_active'] = isset($validated['is_active']) && $validated['is_active'];
        $validated['is_bph']    = isset($validated['is_bph']) && $validated['is_bph'];

        if ($photoFile) {
            $this->deleteLocalFile($staff->photo);
            $validated['photo'] = $photoFile->store('staffs/photos', 'public');
        }

        $periodId = $validated['period_id'] ?? null;
        unset($validated['photo_file'], $validated['period_id']);

        $staff->update($validated);

        if ($periodId) {
            StaffPeriod::updateOrCreate(
                ['period_id' => $periodId, 'staff_id' => $staff->id],
                [
                    'division_id' => $validated['division_id'],
                    'position'    => $validated['position'],
                    'order'       => $validated['order'] ?? 0,
                    'is_bph'      => $validated['is_bph'],
                    'is_active'   => $validated['is_active'],
                ]
            );
        }

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
