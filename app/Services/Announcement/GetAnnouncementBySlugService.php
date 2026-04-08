<?php

namespace App\Services\Announcement;

use App\Models\Announcement;

class GetAnnouncementBySlugService
{
    public function execute(string $slug): Announcement
    {
        return Announcement::with('category')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
