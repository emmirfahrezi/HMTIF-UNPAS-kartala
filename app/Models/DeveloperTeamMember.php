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
        'period_id', 'name', 'role', 'division', 'photo', 'display_order',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];

    public function getPhotoUrlAttribute(): string
    {
        return \media_url($this->photo, 'images/placeholders/member.svg');
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }
}
