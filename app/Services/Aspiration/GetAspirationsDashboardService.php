<?php

namespace App\Services\Aspiration;

use App\Models\Aspiration;
use Illuminate\Http\Request;

class GetAspirationsDashboardService
{
    public function execute(Request $request)
    {
        return Aspiration::query()
            ->when($request->search, fn($q) => $q->where('subject', 'like', "%{$request->search}%"))
            ->latest('created_at')
            ->paginate(10);
    }
}
