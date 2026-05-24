<?php

namespace App\Services\Staff;

use App\Models\Staff;
use Illuminate\Http\UploadedFile;

class CreateStaffService
{
    public function execute(array $validated, ?UploadedFile $photoFile = null): Staff
    {
        $validated['is_active'] = isset($validated['is_active']) && $validated['is_active'];
        $validated['is_bph']    = isset($validated['is_bph']) && $validated['is_bph'];

        // Simpan foto lokal — menimpa URL foto jika ada
        if ($photoFile) {
            $validated['photo'] = $photoFile->store('staffs/photos', 'public');
        }

        // Buang key photo_file agar tidak masuk ke DB
        unset($validated['photo_file']);

        return Staff::create($validated);
    }
}
