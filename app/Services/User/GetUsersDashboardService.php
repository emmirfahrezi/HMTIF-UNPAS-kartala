<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;

class GetUsersDashboardService
{
    public function execute(Request $request)
    {
        $query = User::query()
            ->when($request->search, fn($q) => $q
                ->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%"))
            ->when($request->role, fn($q) => $q->where('role', $request->role));

        match ($request->sort) {
            'oldest' => $query->oldest('created_at'),
            'az'     => $query->orderBy('name'),
            'za'     => $query->orderByDesc('name'),
            default  => $query->latest('created_at'),
        };

        return $query->paginate(10)->withQueryString();
    }
}
