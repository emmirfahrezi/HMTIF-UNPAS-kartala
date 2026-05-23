<?php

namespace App\Services\Staff;

use App\Models\Division;
use Illuminate\Database\Eloquent\Collection;

class GetDivisionsService
{
    /**
     * Ambil semua divisi beserta staff aktifnya.
     *
     * @param bool $excludeBph Jika true, divisi BPH tidak disertakan.
     *                         Gunakan true untuk halaman publik /staff (BPH ditampilkan terpisah).
     *                         Gunakan false untuk API atau konteks yang butuh semua divisi.
     */
    public function execute(bool $excludeBph = false): Collection
    {
        return Division::with([
            'staffs' => fn ($q) => $q->where('is_active', true)->orderBy('order'),
        ])
            ->when($excludeBph, fn ($q) => $q->where('slug', '!=', 'bph'))
            ->orderBy('order')
            ->get();
    }
}
