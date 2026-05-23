<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'act';

    /** Status kegiatan beserta label tampilannya. */
    public const STATUSES = [
        'upcoming' => 'Mendatang',
        'ongoing'  => 'Berlangsung',
        'past'     => 'Selesai',
    ];

    protected $fillable = [
        'title', 'slug', 'description', 'body', 'thumbnail', 'file',
        'start_date', 'end_date', 'location', 'registration_url', 'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    /** Label status dalam Bahasa Indonesia. */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst((string) $this->status);
    }

    /**
     * URL thumbnail yang sudah divalidasi.
     * Jika thumbnail adalah path lokal, kembalikan as-is.
     * Jika kosong atau URL eksternal yang tidak valid, kembalikan placeholder.
     */
    public function getThumbnailUrlAttribute(): string
    {
        $thumbnail = (string) ($this->thumbnail ?? '');

        if ($thumbnail === '') {
            return asset('images/placeholders/activity.svg');
        }

        $isLocal = str_starts_with($thumbnail, '/')
            || str_starts_with($thumbnail, 'storage/')
            || str_starts_with($thumbnail, 'images/')
            || str_starts_with($thumbnail, url('/'));

        return $isLocal ? $thumbnail : asset('images/placeholders/activity.svg');
    }
}