<?php

namespace App\Services\Aspiration;

use App\Models\Aspiration;
use Illuminate\Support\Str;

class SubmitAspirationService
{
    public function execute(array $data): Aspiration
    {
        $data['tracking_code'] = strtoupper(Str::random(10));
        $data['status']        = 'pending';

        return Aspiration::create($data);
    }
}
