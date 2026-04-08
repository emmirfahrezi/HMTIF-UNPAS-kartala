<?php

namespace App\Services\Staff;

use App\Models\Division;
use Illuminate\Database\Eloquent\Collection;

class GetDivisionsService
{
    public function execute(): Collection
    {
        return Division::with([
            'staffs' => fn ($q) => $q->where('is_active', true)->orderBy('order'),
        ])
            ->orderBy('order')
            ->get();
    }
}
