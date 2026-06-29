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
        $allowedStatuses = ['upcoming', 'ongoing', 'past'];
        $status = \in_array($status, $allowedStatuses, true) ? $status : null;

        $query = Activity::query()
            ->when($status, fn ($q) => $q->where('status', $status))
            ->when($search, fn ($q) => $q->where(function ($q) use ($search) {
                $q->where('title',       'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('body',        'like', "%{$search}%")
                  ->orWhere('location',    'like', "%{$search}%");
            }));

        match ($sort) {
            'oldest' => $query->oldest('created_at'),
            'az'     => $query->orderBy('title', 'asc'),
            'za'     => $query->orderBy('title', 'desc'),
            default  => $query->latest('created_at'),
        };

        return $query->paginate(9)->withQueryString();
    }
}
