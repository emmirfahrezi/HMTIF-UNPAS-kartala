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

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? 'Direncanakan';
    }

    public function getStatusClassAttribute(): string
    {
        return match ($this->status) {
            'done'    => 'border-slate-200 bg-white text-slate-500',
            'current' => 'border-primary/30 bg-primary/5 text-primary',
            default   => 'border-slate-200 bg-white/70 text-slate-400',
        };
    }

    public function getDotClassAttribute(): string
    {
        return $this->status === 'current'
            ? 'bg-primary ring-4 ring-primary/15'
            : 'bg-slate-400';
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }
}
