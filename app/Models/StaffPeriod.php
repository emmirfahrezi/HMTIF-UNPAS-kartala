<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffPeriod extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'stp';

    protected $fillable = [
        'period_id', 'staff_id', 'division_id',
        'position', 'order', 'is_bph', 'is_active',
    ];

    protected $casts = [
        'is_bph'   => 'boolean',
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
