<?php

namespace App\Services\Staff;

use App\Models\Period;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Collection;

class GetAllStaffsService
{
    public function execute(?Period $period = null): Collection
    {
        if ($period) {
            return Staff::with([
                'division',
                'periodAssignments' => fn ($q) => $q
                    ->where('period_id', $period->id)
                    ->where('is_active', true),
            ])
            ->whereHas('periodAssignments', fn ($q) => $q
                ->where('period_id', $period->id)
                ->where('is_active', true))
            ->orderByRaw(
                '(SELECT `order` FROM staff_periods WHERE staff_id = staffs.id AND period_id = ? LIMIT 1)',
                [$period->id]
            )
            ->get();
        }

        return Staff::with('division')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }
}
