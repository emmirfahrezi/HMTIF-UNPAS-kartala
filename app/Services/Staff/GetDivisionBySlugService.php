<?php

namespace App\Services\Staff;

use App\Models\Division;

class GetDivisionBySlugService
{
    public function execute(string $slug): Division
    {
        return Division::with([
            'staffs' => fn ($q) => $q->where('is_active', true)->orderBy('order'),
        ])->where('slug', $slug)->firstOrFail();
    }
}
