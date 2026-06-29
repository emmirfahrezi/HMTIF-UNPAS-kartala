<?php

namespace App\Services\Staff;

use App\Models\Division;
use App\Models\Period;
use Illuminate\Database\Eloquent\Collection;

class GetDivisionsService
{
    /**
     * Ambil semua divisi beserta staff aktifnya.
     *
     * @param bool        $excludeBph Jika true, divisi BPH tidak disertakan.
     * @param Period|null $period     Jika diisi, staff difilter berdasarkan assignment periode.
     */
    public function execute(bool $excludeBph = false, ?Period $period = null): Collection
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
        ])
        ->when($excludeBph, fn ($q) => $q->where('slug', '!=', 'bph'))
        ->orderBy('order')
        ->get();
    }
}
