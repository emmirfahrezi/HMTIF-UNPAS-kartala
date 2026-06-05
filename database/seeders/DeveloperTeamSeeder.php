<?php

namespace Database\Seeders;

use App\Models\DeveloperTeamMember;
use App\Models\DeveloperTeamMilestone;
use App\Models\DeveloperTeamSetting;
use App\Models\Period;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class DeveloperTeamSeeder extends Seeder
{
    public function run(): void
    {
        DeveloperTeamSetting::firstOrCreate(
            [],
            [
                'title'       => 'Tim Pengembang HMTIF-UNPAS',
                'description' => 'Kami adalah tim yang bertanggung jawab mengembangkan dan memelihara website resmi HMTIF-UNPAS Kabinet Kartala.',
            ]
        );

        $period = Period::where('label', '2025/2026')->first();
        if (! $period) {
            return;
        }

        $members = [
            ['name' => 'Alfimiftanur', 'role' => 'Fullstack Developer', 'division' => 'KOMINFO', 'display_order' => 1],
            ['name' => 'Emir Fahrezi', 'role' => 'Frontend Developer',  'division' => 'KOMINFO', 'display_order' => 2],
        ];

        foreach ($members as $data) {
            $staff = Staff::where('name', $data['name'])->first();

            $values = $data + ['period_id' => $period->id];
            if ($staff) {
                $values['staff_id'] = $staff->id;
            }

            DeveloperTeamMember::updateOrCreate(
                ['period_id' => $period->id, 'name' => $data['name']],
                $values
            );
        }

        $milestones = [
            ['period_label' => 'Jun 2025', 'title' => 'Inisiasi Proyek',     'description' => 'Setup repositori, arsitektur awal, dan tim inti.', 'status' => 'done',    'display_order' => 1],
            ['period_label' => 'Sep 2025', 'title' => 'Rilis Beta',          'description' => 'Peluncuran versi beta untuk pengujian internal.',    'status' => 'done',    'display_order' => 2],
            ['period_label' => 'Jan 2026', 'title' => 'Rilis v1.0',          'description' => 'Peluncuran resmi website ke publik.',                'status' => 'current', 'display_order' => 3],
            ['period_label' => 'Jun 2026', 'title' => 'Handover Periode',    'description' => 'Dokumentasi dan serah terima ke tim periode berikutnya.', 'status' => 'planned', 'display_order' => 4],
        ];

        foreach ($milestones as $data) {
            DeveloperTeamMilestone::updateOrCreate(
                ['period_id' => $period->id, 'title' => $data['title']],
                $data + ['period_id' => $period->id]
            );
        }
    }
}
