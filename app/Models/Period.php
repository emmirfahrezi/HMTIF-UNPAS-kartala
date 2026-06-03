<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Period extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'per';

    protected $fillable = ['label', 'is_active', 'display_order'];

    protected $casts = [
        'is_active'     => 'boolean',
        'display_order' => 'integer',
    ];

    protected static function booted(): void
    {
        // Saat satu periode diaktifkan, nonaktifkan yang lain
        static::saving(function (self $period) {
            if ($period->is_active && $period->isDirty('is_active')) {
                static::where('id', '!=', $period->id)->update(['is_active' => false]);
            }
        });
    }

    /**
     * Resolve periode yang diminta dari query param `?period=`, fallback ke periode aktif.
     */
    public static function resolveFromRequest(Request $request, ?Collection $periods = null): ?self
    {
        $label   = $request->query('period');
        $periods = $periods ?? static::orderBy('display_order')->get();

        if ($label) {
            return $periods->firstWhere('label', $label);
        }

        return $periods->firstWhere('is_active', true);
    }

    public function staffPeriods(): HasMany
    {
        return $this->hasMany(StaffPeriod::class);
    }
}
