<?php

namespace App\Services\Staff;

use App\Models\Division;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class GetStaffsDashboardService
{
    public function execute(Request $request)
    {
        return Division::with(['staffs' => function ($query) use ($request) {
            $query->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"));
        }])
            ->when($request->division, fn($q) => $q->where('id', $request->division))
            ->orderBy('order')
            ->get();
    }
}
