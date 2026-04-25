<?php

namespace App\Services\Staff;

use App\Models\Staff;

class CreateStaffService
{
    public function execute(array $validated): Staff
    {
        $validated['is_active'] = isset($validated['is_active']) && $validated['is_active'];
        $validated['is_bph'] = isset($validated['is_bph']) && $validated['is_bph'];

        return Staff::create($validated);
    }
}
