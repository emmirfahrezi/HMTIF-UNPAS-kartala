<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MinuteAttendee extends Model
{
    protected $fillable = [
        'minute_id',
        'name',
        'nim',
        'jabatan',
        'keterangan',
        'paraf',
        'order',
    ];

    public function minute(): BelongsTo
    {
        return $this->belongsTo(Minute::class);
    }
}
