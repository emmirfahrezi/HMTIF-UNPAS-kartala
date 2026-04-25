<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Http\Request;

class GetActivitiesDashboardService
{
    public function execute(Request $request)
    {
        return Activity::query()
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest('created_at')
            ->paginate(10);
    }
}
