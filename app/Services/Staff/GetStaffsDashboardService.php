<?php

namespace App\Services\Staff;

use App\Models\Division;
use App\Models\Period;
use Illuminate\Http\Request;

class GetStaffsDashboardService
{
    public function execute(Request $request, ?Period $period = null)
    {
        $divisions = Division::with(['staffs' => function ($query) use ($request, $period) {
            if ($period) {
                $query->whereHas('periodAssignments', fn ($q) => $q->where('period_id', $period->id));
                $query->with(['periodAssignments' => fn ($q) => $q->where('period_id', $period->id)]);
            }

            $query->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%"));

            $defaultOrder = $period
                ? fn ($q) => $q->orderByRaw(
                    '(SELECT `order` FROM staff_periods WHERE staff_id = staffs.id AND period_id = ? LIMIT 1)',
                    [$period->id]
                )
                : fn ($q) => $q->orderBy('order');

            match ($request->sort) {
                'oldest' => $query->oldest('created_at'),
                'az'     => $query->orderBy('name'),
                'za'     => $query->orderByDesc('name'),
                'latest' => $query->latest('created_at'),
                default  => $defaultOrder($query),
            };
        }])
        ->when($request->division, fn ($q) => $q->where('id', $request->division))
        ->orderBy('order')
        ->get();

        if ($request->filled('search')) {
            $divisions = $divisions->filter(fn ($division) => $division->staffs->isNotEmpty());
        }

        return $divisions;
    }
}
