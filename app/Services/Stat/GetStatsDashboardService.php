<?php

namespace App\Services\Stat;

use App\Models\Stat;
use Illuminate\Http\Request;

class GetStatsDashboardService
{
    public function execute(Request $request)
    {
        return Stat::orderBy('order')->paginate(10);
    }
}
