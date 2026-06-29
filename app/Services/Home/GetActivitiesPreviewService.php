<?php

namespace App\Services\Home;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Collection;

class GetActivitiesPreviewService
{
    public function execute(int $limit = 8): Collection
    {
        return Activity::where('status', 'upcoming')
            ->orderBy('start_date')
            ->limit($limit)
            ->get();
    }
}
