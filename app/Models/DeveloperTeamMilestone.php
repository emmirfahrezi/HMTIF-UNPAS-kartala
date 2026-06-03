<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeveloperTeamMilestone extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'dtl';

    public const STATUSES = [
        'done'    => 'Selesai',
        'current' => 'Sedang Berjalan',
        'planned' => 'Direncanakan',
    ];

    protected $fillable = [
        'period_id', 'period_label', 'title', 'description', 'status', 'display_order',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }
}
