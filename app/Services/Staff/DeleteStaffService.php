<?php

namespace App\Services\Staff;

use App\Models\Staff;

class DeleteStaffService
{
    public function execute(Staff $staff): void
    {
        $staff->delete();
    }
}
