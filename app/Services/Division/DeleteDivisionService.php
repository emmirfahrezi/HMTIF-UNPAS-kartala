<?php

namespace App\Services\Division;

use App\Models\Division;

class DeleteDivisionService
{
    public function execute(Division $division): void
    {
        $division->delete();
    }
}
