<?php

namespace App\Services\Aspiration;

use App\Models\Aspiration;
use Illuminate\Database\Eloquent\Collection;

class GetWeeklySpotlightService
{
    public function execute(): Collection
    {
        return Aspiration::where('is_spotlight', true)
            ->where('spotlighted_week', now()->startOfWeek()->toDateString())
            ->get();
    }
}
