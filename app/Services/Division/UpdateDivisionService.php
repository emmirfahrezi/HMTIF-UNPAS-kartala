<?php

namespace App\Services\Division;

use App\Models\Division;

class UpdateDivisionService
{
    public function execute(Division $division, array $validated): Division
    {
        $division->update($validated);

        return $division;
    }
}
