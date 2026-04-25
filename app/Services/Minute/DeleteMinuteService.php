<?php

namespace App\Services\Minute;

use App\Models\Minute;
use Illuminate\Support\Facades\Storage;

class DeleteMinuteService
{
    public function execute(Minute $minute): void
    {
        if ($minute->dokumentasi_file) {
            Storage::disk('public')->delete($minute->dokumentasi_file);
        }

        $minute->delete();
    }
}
