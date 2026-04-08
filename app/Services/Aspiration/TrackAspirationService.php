<?php

namespace App\Services\Aspiration;

use App\Models\Aspiration;

class TrackAspirationService
{
    public function execute(string $trackingCode): Aspiration
    {
        return Aspiration::where('tracking_code', $trackingCode)->firstOrFail();
    }
}
