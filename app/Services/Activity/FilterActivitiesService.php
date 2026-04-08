<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;

class FilterActivitiesService
{
    public function execute(array $filters): LengthAwarePaginator
    {
        return Activity::query()
            ->when(
                isset($filters['status']),
                fn ($q) => $q->where('status', $filters['status'])
            )
            ->when(
                isset($filters['search']),
                fn ($q) => $q->where('title', 'like', '%' . $filters['search'] . '%')
            )
            ->orderBy('start_date', 'desc')
            ->paginate(9);
    }
}
