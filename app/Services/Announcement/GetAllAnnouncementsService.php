<?php

namespace App\Services\Announcement;

use App\Models\Announcement;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllAnnouncementsService
{
    /**
     * Ambil semua pengumuman yang sudah dipublikasikan dengan dukungan filter,
     * pencarian, dan pengurutan.
     *
     * @param  int|null    $categoryId  Filter berdasarkan kategori
     * @param  string|null $search      Cari berdasarkan judul atau excerpt
     * @param  string|null $sort        Urutan: 'latest' | 'oldest' | 'az' | 'za'
     */
    public function execute(
        ?int    $categoryId = null,
        ?string $search     = null,
        ?string $sort       = 'latest',
    ): LengthAwarePaginator {
        return Announcement::with('category')
            ->when($categoryId, fn ($q) => $q->where('announcement_category_id', $categoryId))
            ->when($search, fn ($q) => $q->where(function ($q) use ($search) {
                $q->where('title',   'like', '%' . $search . '%')
                  ->orWhere('excerpt', 'like', '%' . $search . '%');
            }))
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->when(true, function ($q) use ($sort) {
                match ($sort) {
                    'oldest' => $q->orderBy('published_at', 'asc'),
                    'az'     => $q->orderBy('title', 'asc'),
                    'za'     => $q->orderBy('title', 'desc'),
                    default  => $q->orderBy('published_at', 'desc'), // 'latest'
                };
            })
            ->paginate(10)
            ->withQueryString();
    }
}
