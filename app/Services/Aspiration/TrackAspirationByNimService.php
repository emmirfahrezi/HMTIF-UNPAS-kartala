<?php

namespace App\Services\Aspiration;

use App\Models\Aspiration;
use Illuminate\Database\Eloquent\Collection;

class TrackAspirationByNimService
{
    public function execute(string $nim): Collection
    {
        return Aspiration::where('nim', $nim)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
