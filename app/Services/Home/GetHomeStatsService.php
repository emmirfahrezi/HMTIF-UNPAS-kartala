<?php

namespace App\Services\Home;

use App\Models\Activity;
use App\Models\Division;
use App\Models\Staff;
use Illuminate\Support\Collection;

class GetHomeStatsService
{
    public function execute(): Collection
    {
        return collect([
            (object) ['label' => 'Pengurus Aktif',   'value' => Staff::count(),    'icon' => 'user-group'],
            (object) ['label' => 'Agenda Proker',    'value' => Activity::count(), 'icon' => 'calendar-days'],
            (object) ['label' => 'Departemen',       'value' => Division::count(), 'icon' => 'building-office-2'],
            (object) ['label' => 'Anggota Himpunan', 'value' => '300+',            'icon' => 'users'],
        ]);
    }
}
