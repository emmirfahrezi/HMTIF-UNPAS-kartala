<?php

namespace App\Services\User;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class GetUsersDashboardService
{
    public function execute(Request $request)
    {
        return User::query()
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%")->orWhere('email', 'like', "%{$request->search}%"))
            ->when($request->role, fn($q) => $q->where('role', $request->role))
            ->latest('created_at')
            ->paginate(10);
    }
}
