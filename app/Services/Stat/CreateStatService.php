<?php

namespace App\Services\Stat;

use App\Models\Stat;

class CreateStatService
{
    public function execute(array $validated): Stat
    {
        return Stat::create($validated);
    }
}
