<?php

namespace App\Services\Staff;

use App\Models\Staff;

class GetStaffByIdService
{
    public function execute(int $id): Staff
    {
        return Staff::with('division')->findOrFail($id);
    }
}
