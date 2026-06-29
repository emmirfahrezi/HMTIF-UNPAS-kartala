<?php

namespace App\Services\Division;

use App\Models\Division;

class CreateDivisionService
{
    public function execute(array $validated): Division
    {
        return Division::create($validated);
    }
}
