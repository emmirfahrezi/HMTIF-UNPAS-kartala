<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnnouncementCategory extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'anc';

    protected $fillable = ['name', 'slug'];

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }
}