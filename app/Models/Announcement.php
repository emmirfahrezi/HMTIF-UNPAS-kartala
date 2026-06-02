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

    public function getThumbnailUrlAttribute(): string
    {
        return media_url($this->thumbnail, 'images/placeholders/announcement.svg');
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