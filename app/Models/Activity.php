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

    public function getThumbnailUrlAttribute(): string
    {
        return \media_url($this->thumbnail, 'images/placeholders/activity.svg');
    }
}