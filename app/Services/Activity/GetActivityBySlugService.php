<?php

namespace App\Services\Activity;

use App\Models\Activity;

class GetActivityBySlugService
{
    public function execute(string $slug): Activity
    {
        return Activity::where('slug', $slug)->firstOrFail();
    }
}
