<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeveloperTeamMember extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'dtm';

    protected $fillable = [
        'period_id', 'staff_id', 'name', 'role', 'division', 'photo', 'display_order',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];

    /** Nama tampilan: ambil dari staff jika ada, fallback ke field cache. */
    public function getDisplayNameAttribute(): string
    {
        return $this->staff?->name ?? $this->name ?? '';
    }

    /** Nama divisi tampilan: ambil dari divisi staff jika ada, fallback ke field cache. */
    public function getDivisionNameAttribute(): string
    {
        return $this->staff?->division?->name ?? $this->division ?? '';
    }

    /** URL foto: ambil dari staff jika relation di-load, fallback ke field cache. */
    public function getPhotoUrlAttribute(): string
    {
        if ($this->relationLoaded('staff') && $this->staff) {
            return $this->staff->photo_url;
        }

        return \media_url($this->photo, 'images/placeholders/member.svg');
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
