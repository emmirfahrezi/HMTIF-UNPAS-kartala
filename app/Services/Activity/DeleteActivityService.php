<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

class DeleteActivityService
{
    public function execute(Activity $activity): void
    {
        if ($activity->file) {
            Storage::disk('public')->delete($activity->file);
        }

        $activity->delete();
    }
}
