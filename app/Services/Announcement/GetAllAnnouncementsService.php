<?php

namespace App\Services\Announcement;

use App\Models\Announcement;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllAnnouncementsService
{
    public function execute(?int $categoryId = null): LengthAwarePaginator
    {
        return Announcement::with('category')
            ->when($categoryId, fn ($q) => $q->where('announcement_category_id', $categoryId))
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);
    }
}
