<?php

namespace App\Services\Stat;

use App\Models\Stat;

class UpdateStatService
{
    public function execute(Stat $stat, array $validated): Stat
    {
        $stat->update($validated);

        return $stat;
    }
}
