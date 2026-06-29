<?php

namespace App\Services\Minute;

use App\Models\Minute;
use Illuminate\Http\Request;

class GetMinutesDashboardService
{
    public function execute(Request $request)
    {
        return Minute::query()
            ->with('division')
            ->when($request->search, fn ($q) => $q->where(fn ($sub) => $sub
                ->where('nomor', 'like', "%{$request->search}%")
                ->orWhere('perihal', 'like', "%{$request->search}%")))
            ->when($request->filled('division'), fn ($q) => $q->where('division_id', $request->division))
            ->when($request->sort === 'oldest', fn ($q) => $q->oldest('tanggal'))
            ->when($request->sort === 'az', fn ($q) => $q->orderBy('perihal'))
            ->when($request->sort === 'za', fn ($q) => $q->orderByDesc('perihal'))
            ->when(! \in_array($request->sort, ['oldest', 'az', 'za'], true), fn ($q) => $q->latest('tanggal'))
            ->paginate(10)
            ->withQueryString();
    }
}
