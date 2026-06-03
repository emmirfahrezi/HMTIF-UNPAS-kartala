<?php

namespace App\Services\DeveloperTeam;

use App\Models\DeveloperTeamMember;
use App\Models\DeveloperTeamMilestone;
use App\Models\DeveloperTeamSetting;
use App\Models\Period;

class SaveDeveloperTeamContentService
{
    public function execute(array $validated, Period $period): void
    {
        // Simpan copy hero global (upsert — selalu satu record)
        $setting = DeveloperTeamSetting::first() ?? new DeveloperTeamSetting();
        $setting->fill([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? '',
        ]);
        $setting->save();

        // Hapus anggota dan milestone lama untuk periode ini, lalu buat ulang
        DeveloperTeamMember::where('period_id', $period->id)->delete();
        DeveloperTeamMilestone::where('period_id', $period->id)->delete();

        foreach ($validated['members'] ?? [] as $order => $data) {
            if (empty($data['name']) && empty($data['role'])) {
                continue;
            }

            DeveloperTeamMember::create([
                'period_id'     => $period->id,
                'name'          => $data['name'] ?? '',
                'role'          => $data['role'] ?? '',
                'division'      => $data['division'] ?? null,
                'photo'         => $data['photo'] ?? null,
                'display_order' => (int) $order,
            ]);
        }

        foreach ($validated['milestones'] ?? [] as $order => $data) {
            if (empty($data['title'])) {
                continue;
            }

            DeveloperTeamMilestone::create([
                'period_id'     => $period->id,
                'period_label'  => $data['period'] ?? '',
                'title'         => $data['title'],
                'description'   => $data['description'] ?? null,
                'status'        => $data['status'] ?? 'planned',
                'display_order' => (int) $order,
            ]);
        }
    }
}
