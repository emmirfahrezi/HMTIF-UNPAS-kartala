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
            ['name' => 'Alfi Mifta Nurhakim', 'role' => 'Fullstack Developer', 'division' => 'KOMINFO', 'display_order' => 1],
            ['name' => 'Aufa Ramadhan',        'role' => 'Backend Developer',   'division' => 'KOMINFO', 'display_order' => 2],
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
            [
                'period_label'  => 'Jun 2025',
                'title'         => 'Perencanaan & Arsitektur Sistem',
                'description'   => 'Perancangan arsitektur website, penentuan tech stack, setup repositori, dan pembentukan tim pengembang HMTIF-UNPAS Kabinet Kartala.',
                'status'        => 'done',
                'display_order' => 1,
            ],
            [
                'period_label'  => 'Sep 2025',
                'title'         => 'Pengembangan Fitur Aspirasi Mahasiswa',
                'description'   => 'Implementasi modul aspirasi yang memungkinkan mahasiswa menyampaikan masukan, saran, dan aspirasi secara digital kepada pengurus.',
                'status'        => 'done',
                'display_order' => 2,
            ],
            [
                'period_label'  => 'Jan 2026',
                'title'         => 'Implementasi Modul Pengarsipan Digital',
                'description'   => 'Pembangunan sistem pengarsipan dokumen dan aset organisasi yang terstruktur, mudah dicari, dan dapat diakses oleh pengurus berwenang.',
                'status'        => 'current',
                'display_order' => 3,
            ],
            [
                'period_label'  => 'Mar 2026',
                'title'         => 'Modul Notulensi & Berita Acara',
                'description'   => 'Pengembangan fitur pencatatan notulensi rapat dan pembuatan berita acara resmi secara digital dengan manajemen peserta dan tanda tangan.',
                'status'        => 'planned',
                'display_order' => 4,
            ],
            [
                'period_label'  => 'Jun 2026',
                'title'         => 'Sistem Role Access & Menu Access',
                'description'   => 'Implementasi manajemen hak akses berbasis peran (Role-Based Access Control) untuk mengatur navigasi menu dan fitur bagi setiap level anggota pengurus.',
                'status'        => 'planned',
                'display_order' => 5,
            ],
        ];

        foreach ($milestones as $data) {
            DeveloperTeamMilestone::updateOrCreate(
                ['period_id' => $period->id, 'title' => $data['title']],
                $data + ['period_id' => $period->id]
            );
        }
    }
}
