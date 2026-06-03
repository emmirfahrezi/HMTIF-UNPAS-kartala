<?php

namespace App\Services\DeveloperTeam;

use App\Models\DeveloperTeamMember;
use App\Models\DeveloperTeamMilestone;
use App\Models\Period;

class DeleteDeveloperTeamPeriodContentService
{
    /**
     * Hapus semua anggota dan milestone Tim Pengembang untuk periode tertentu.
     * Record `periods` tidak dihapus.
     */
    public function execute(Period $period): void
    {
        DeveloperTeamMember::where('period_id', $period->id)->delete();
        DeveloperTeamMilestone::where('period_id', $period->id)->delete();
    }
}
