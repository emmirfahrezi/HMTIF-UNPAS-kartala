<?php

namespace App\Services\Aspiration;

use App\Models\Aspiration;
use Illuminate\Http\Request;

class GetAspirationsDashboardService
{
    public function execute(Request $request)
    {
        $query = Aspiration::query()
            ->when($request->search, fn($q) => $q->where('subject', 'like', "%{$request->search}%"));

        match ($request->sort) {
            'oldest' => $query->oldest('created_at'),
            default  => $query->latest('created_at'),
        };

        return $query->paginate(10)->withQueryString();
    }
}
