<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllActivitiesService
{
    public function execute(?string $status = null): LengthAwarePaginator
    {
        return Activity::query()
            ->when($status, fn ($q) => $q->where('status', $status))
            ->orderBy('start_date', 'desc')
            ->paginate(9);
    }
}
