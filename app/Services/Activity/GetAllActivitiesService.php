<?php

namespace App\Services\Activity;

use App\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllActivitiesService
{
    /**
     * Ambil semua kegiatan dengan dukungan filter status, pencarian, dan pengurutan.
     *
     * @param  string|null $status  Filter status: 'upcoming' | 'ongoing' | 'past'
     * @param  string|null $search  Cari berdasarkan judul atau deskripsi
     * @param  string|null $sort    Urutan: 'latest' | 'oldest' | 'az' | 'za'
     */
    public function execute(
        ?string $status = null,
        ?string $search = null,
        ?string $sort   = 'latest',
    ): LengthAwarePaginator {
        return Activity::query()
            ->when($status, fn ($q) => $q->where('status', $status))
            ->when($search, fn ($q) => $q->where(function ($q) use ($search) {
                $q->where('title',       'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            }))
            ->when(true, function ($q) use ($sort) {
                match ($sort) {
                    'oldest' => $q->orderBy('start_date', 'asc'),
                    'az'     => $q->orderBy('title', 'asc'),
                    'za'     => $q->orderBy('title', 'desc'),
                    default  => $q->orderBy('start_date', 'desc'), // 'latest'
                };
            })
            ->paginate(9)
            ->withQueryString();
    }
}
