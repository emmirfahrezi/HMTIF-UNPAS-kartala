<?php

namespace App\Services\Stat;

use App\Models\Stat;

class DeleteStatService
{
    public function execute(Stat $stat): void
    {
        $stat->delete();
    }
}
