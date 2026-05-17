<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Http\Request;

class GetActivitiesDashboardService
{
    public function execute(Request $request)
    {
        $query = Activity::query()
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->status, fn($q) => $q->where('status', $request->status));

        match ($request->sort) {
            'oldest' => $query->oldest('created_at'),
            'az'     => $query->orderBy('title'),
            'za'     => $query->orderByDesc('title'),
            default  => $query->latest('created_at'),
        };

        return $query->paginate(10)->withQueryString();
    }
}
