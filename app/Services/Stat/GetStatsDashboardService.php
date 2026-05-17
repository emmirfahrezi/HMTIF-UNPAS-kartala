<?php

namespace App\Services\Stat;

use App\Models\Stat;
use Illuminate\Http\Request;

class GetStatsDashboardService
{
    public function execute(Request $request)
    {
        $query = Stat::query()
            ->when($request->search, fn($q) => $q->where('label', 'like', "%{$request->search}%"));

        match ($request->sort) {
            'oldest' => $query->oldest('created_at'),
            'az'     => $query->orderBy('label'),
            'za'     => $query->orderByDesc('label'),
            'latest' => $query->latest('created_at'),
            default  => $query->orderBy('order'),
        };

        return $query->paginate(10)->withQueryString();
    }
}
