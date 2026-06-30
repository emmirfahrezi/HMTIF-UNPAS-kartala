<?php

namespace App\Services\DeveloperTeam;

use App\Models\DeveloperTeamMember;
use App\Models\DeveloperTeamMilestone;
use App\Models\DeveloperTeamSetting;
use App\Models\Period;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class SaveDeveloperTeamContentService
{
    public function execute(array $validated, Period $period): void
    {
        DB::transaction(function () use ($validated, $period) {
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
            if (empty($data['staff_id']) && empty($data['role'])) {
                continue;
            }

            // Ambil data staff untuk di-cache sebagai fallback
            $staff = ! empty($data['staff_id'])
                ? Staff::with('division')->find($data['staff_id'])
                : null;

            DeveloperTeamMember::create([
                'period_id'     => $period->id,
                'staff_id'      => $staff?->id,
                'role'          => $data['role'] ?? '',
                // Cache fallback agar data lama tanpa staff_id tetap tampil
                'name'          => $staff?->name ?? '',
                'division'      => $staff?->division?->name ?? null,
                'photo'         => $staff?->photo ?? null,
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
        }); // end DB::transaction
    }
}
