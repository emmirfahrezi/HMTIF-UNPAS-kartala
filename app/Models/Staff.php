<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staff extends Model
{
    protected $fillable = [
        'division_id', 'name', 'position', 'photo', 'bio',
        'instagram', 'linkedin', 'order', 'is_active', 'is_bph',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_bph'    => 'boolean',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
