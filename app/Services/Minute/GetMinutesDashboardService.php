<?php

namespace App\Services\Minute;

use App\Models\Minute;
use Illuminate\Http\Request;

class GetMinutesDashboardService
{
    public function execute(Request $request)
    {
        return Minute::query()
            ->when($request->search, fn($q) => $q->where('nomor', 'like', "%{$request->search}%")->orWhere('perihal', 'like', "%{$request->search}%"))
            ->latest('tanggal')
            ->paginate(10);
    }
}
