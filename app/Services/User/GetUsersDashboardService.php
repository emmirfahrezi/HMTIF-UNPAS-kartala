<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;

class GetUsersDashboardService
{
    public function execute(Request $request)
    {
        $query = User::query()
            ->with('staff')
            ->when($request->search, fn($q) => $q
                ->where('email', 'like', "%{$request->search}%")
                ->orWhereHas('staff', fn($sq) => $sq->where('name', 'like', "%{$request->search}%")))
            ->when($request->role, fn($q) => $q->where('role', $request->role));

        match ($request->sort) {
            'oldest' => $query->oldest('created_at'),
            default  => $query->latest('created_at'),
        };

        return $query->paginate(10)->withQueryString();
    }
}
