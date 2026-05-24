<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'ann';

    protected $fillable = [
        'announcement_category_id', 'title', 'slug',
        'excerpt', 'body', 'thumbnail', 'file', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * URL thumbnail yang sudah divalidasi.
     * Jika path lokal → kembalikan as-is.
     * Jika kosong → kembalikan placeholder.
     */
    public function getThumbnailUrlAttribute(): string
    {
        $thumbnail = (string) ($this->thumbnail ?? '');

        if ($thumbnail === '') {
            return asset('images/placeholders/announcement.svg');
        }

        $isLocal = str_starts_with($thumbnail, '/')
            || str_starts_with($thumbnail, 'storage/')
            || str_starts_with($thumbnail, 'images/')
            || str_starts_with($thumbnail, url('/'));

        return $isLocal ? $thumbnail : asset('images/placeholders/announcement.svg');
    }

    /**
     * Nama kategori pengumuman.
     * Fallback ke 'Umum' jika belum dikategorikan.
     */
    public function getCategoryNameAttribute(): string
    {
        return $this->category?->name ?? 'Umum';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(AnnouncementCategory::class, 'announcement_category_id');
    }
}