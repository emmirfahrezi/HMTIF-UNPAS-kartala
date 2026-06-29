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
            ->when($request->search, fn($q) => $q->where(fn($sub) => $sub
                ->where('email', 'like', "%{$request->search}%")
                ->orWhereHas('staff', fn($sq) => $sq->where('name', 'like', "%{$request->search}%"))))
            ->when($request->role, fn($q) => $q->where('role', $request->role));

        match ($request->sort) {
            'oldest' => $query->oldest('users.created_at'),
            'az'     => $query->leftJoin('staffs', 'users.staff_id', '=', 'staffs.id')
                             ->orderBy('staffs.name', 'asc')
                             ->orderBy('users.email', 'asc')
                             ->select('users.*'),
            'za'     => $query->leftJoin('staffs', 'users.staff_id', '=', 'staffs.id')
                             ->orderByDesc('staffs.name')
                             ->orderByDesc('users.email')
                             ->select('users.*'),
            default  => $query->latest('users.created_at'),
        };

        return $query->paginate(10)->withQueryString();
    }
}
