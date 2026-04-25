<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateActivityService
{
    public function execute(Activity $activity, array $validated, ?UploadedFile $file = null): Activity
    {
        if ($file) {
            if ($activity->file) {
                Storage::disk('public')->delete($activity->file);
            }
            $validated['file'] = $file->store('activities/files', 'public');
        }

        $activity->update($validated);

        return $activity;
    }
}
