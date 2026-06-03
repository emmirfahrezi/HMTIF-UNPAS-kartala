<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    public function run(): void
    {
        Period::updateOrCreate(
            ['label' => '2025/2026'],
            ['is_active' => true, 'display_order' => 1]
        );
    }
}
