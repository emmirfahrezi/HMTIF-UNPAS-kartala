<?php

namespace App\Services\Division;

use App\Models\Division;
use Illuminate\Http\Request;

class GetDivisionsDashboardService
{
    public function execute(Request $request)
    {
        return Division::withCount('staffs')
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->orderBy('order')
            ->paginate(10);
    }
}
