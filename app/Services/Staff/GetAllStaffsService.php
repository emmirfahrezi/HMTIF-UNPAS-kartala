<?php

namespace App\Services\Staff;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Collection;

class GetAllStaffsService
{
    public function execute(): Collection
    {
        return Staff::with('division')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }
}
