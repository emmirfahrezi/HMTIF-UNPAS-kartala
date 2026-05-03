<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MinuteAttendee extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'mna';

    protected $fillable = [
        'minute_id', 'name', 'nim', 'jabatan',
        'keterangan', 'paraf', 'order',
    ];

    public function minute(): BelongsTo
    {
        return $this->belongsTo(Minute::class);
    }
}