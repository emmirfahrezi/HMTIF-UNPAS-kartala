<?php

namespace App\Services\Announcement;

use App\Models\Announcement;
use Illuminate\Http\Request;

class GetAnnouncementsService
{
    public function execute(Request $request)
    {
        return Announcement::query()
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('announcement_category_id', $request->category))
            ->latest('published_at')
            ->paginate(10);
    }
}
