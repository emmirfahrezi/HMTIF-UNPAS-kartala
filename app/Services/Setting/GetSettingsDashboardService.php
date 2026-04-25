<?php

namespace App\Services\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;

class GetSettingsDashboardService
{
    public function execute(Request $request)
    {
        return Setting::query()
            ->when($request->search, fn($q) => $q->where('key', 'like', "%{$request->search}%")->orWhere('value', 'like', "%{$request->search}%"))
            ->when($request->group, fn($q) => $q->where('group', $request->group))
            ->latest('id')
            ->paginate(10);
    }
}
