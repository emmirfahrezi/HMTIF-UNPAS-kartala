<?php

namespace App\Services\Announcement;

use App\Models\Announcement;
use Illuminate\Http\Request;

class GetAnnouncementsService
{
    public function execute(Request $request)
    {
        $query = Announcement::query()
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('announcement_category_id', $request->category));

        match ($request->sort) {
            'oldest' => $query->oldest('published_at'),
            'az'     => $query->orderBy('title'),
            'za'     => $query->orderByDesc('title'),
            default  => $query->latest('published_at'),
        };

        return $query->paginate(10)->withQueryString();
    }
}
