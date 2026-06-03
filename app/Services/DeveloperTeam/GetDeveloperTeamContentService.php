<?php

namespace App\Services\DeveloperTeam;

use App\Models\DeveloperTeamMember;
use App\Models\DeveloperTeamMilestone;
use App\Models\DeveloperTeamSetting;
use App\Models\Period;

class GetDeveloperTeamContentService
{
    /**
     * Ambil konten Tim Pengembang untuk periode tertentu.
     *
     * Title/description bersifat global (tidak berubah per periode).
     * Members dan milestones difilter berdasarkan $period.
     *
     * @return array{title: string, description: string, members: \Illuminate\Database\Eloquent\Collection, milestones: \Illuminate\Database\Eloquent\Collection}
     */
    public function execute(?Period $period = null): array
    {
        $setting = DeveloperTeamSetting::first();

        $members    = $period
            ? DeveloperTeamMember::where('period_id', $period->id)->orderBy('display_order')->get()
            : collect();

        $milestones = $period
            ? DeveloperTeamMilestone::where('period_id', $period->id)->orderBy('display_order')->get()
            : collect();

        return [
            'title'       => $setting?->title ?? '',
            'description' => $setting?->description ?? '',
            'members'     => $members,
            'milestones'  => $milestones,
        ];
    }
}
