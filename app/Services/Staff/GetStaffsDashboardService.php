<?php

namespace App\Services\Staff;

use App\Models\Division;
use Illuminate\Http\Request;

class GetStaffsDashboardService
{
    public function execute(Request $request)
    {
        return Division::with(['staffs' => function ($query) use ($request) {
            $query->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"));

            match ($request->sort) {
                'oldest' => $query->oldest('created_at'),
                'az'     => $query->orderBy('name'),
                'za'     => $query->orderByDesc('name'),
                'latest' => $query->latest('created_at'),
                default  => $query->orderBy('order'),
            };
        }])
            ->when($request->division, fn($q) => $q->where('id', $request->division))
            ->orderBy('order')
            ->get();
    }
}
