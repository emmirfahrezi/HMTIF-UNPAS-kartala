<?php

namespace App\Services\Staff;

use App\Models\Division;
use App\Models\Period;

class GetDivisionBySlugService
{
    public function execute(string $slug, ?Period $period = null): Division
    {
        return Division::with([
            'staffs' => function ($q) use ($period) {
                if ($period) {
                    $q->whereHas('periodAssignments', fn ($sq) => $sq
                        ->where('period_id', $period->id)
                        ->where('is_active', true))
                      ->with(['periodAssignments' => fn ($sq) => $sq
                        ->where('period_id', $period->id)
                        ->where('is_active', true)])
                      ->orderByRaw(
                          '(SELECT `order` FROM staff_periods WHERE staff_id = staffs.id AND period_id = ? LIMIT 1)',
                          [$period->id]
                      );
                } else {
                    $q->where('is_active', true)->orderBy('order');
                }
            },
        ])->where('slug', $slug)->firstOrFail();
    }
}
