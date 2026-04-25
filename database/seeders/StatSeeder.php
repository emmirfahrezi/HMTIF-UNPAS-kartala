<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            [
                'label' => 'Pengurus Aktif',
                'value' => '31+',
                'icon'  => 'user-group',
                'order' => 1,
            ],
            [
                'label' => 'Agenda Proker',
                'value' => '12+',
                'icon'  => 'calendar-days',
                'order' => 2,
            ],
            [
                'label' => 'Departemen',
                'value' => '5',
                'icon'  => 'building-office-2',
                'order' => 3,
            ],
            [
                'label' => 'Anggota Himpunan',
                'value' => '300+',
                'icon'  => 'users',
                'order' => 4,
            ],
        ];

        foreach ($stats as $data) {
            Stat::updateOrCreate(['label' => $data['label']], $data);
        }
    }
}
