<?php

namespace App\Services\Home;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Collection;

class GetAnnouncementsPreviewService
{
    public function execute(int $limit = 4): Collection
    {
        return Announcement::with('category')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
