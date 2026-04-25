<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Http\UploadedFile;

class CreateActivityService
{
    public function execute(array $validated, ?UploadedFile $file = null): Activity
    {
        if ($file) {
            $validated['file'] = $file->store('activities/files', 'public');
        }

        return Activity::create($validated);
    }
}
