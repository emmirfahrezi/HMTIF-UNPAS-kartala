<?php

namespace App\Services\Home;

use App\Models\Stat;
use Illuminate\Database\Eloquent\Collection;

class GetHomeStatsService
{
    public function execute(): Collection
    {
        return Stat::orderBy('order')->get();
    }
}
