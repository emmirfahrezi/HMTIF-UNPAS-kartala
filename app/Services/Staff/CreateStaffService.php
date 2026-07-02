<?php

namespace App\Services\Staff;

use App\Models\Staff;
use App\Models\StaffPeriod;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class CreateStaffService
{
    public function execute(array $validated, ?UploadedFile $photoFile = null): Staff
    {
        $validated['is_active'] = isset($validated['is_active']) && $validated['is_active'];
        $validated['is_bph']    = isset($validated['is_bph']) && $validated['is_bph'];

        if ($photoFile) {
            $validated['photo'] = $photoFile->store('staffs/photos', 'public');
        }

        $periodId = $validated['period_id'] ?? null;
        unset($validated['photo_file'], $validated['period_id']);

        return DB::transaction(function () use ($validated, $periodId) {
            $staff = Staff::create($validated);

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
        });
    }
}
