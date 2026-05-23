<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'log';

    protected $fillable = [
        'user_id', 'action', 'model_type', 'model_id', 'description',
    ];

    private static array $actionLabels = [
        'created' => 'Dibuat',
        'updated' => 'Diperbarui',
        'deleted' => 'Dihapus',
        'login'   => 'Login',
        'logout'  => 'Logout',
    ];

    public static function record(string $action, Model $model, string $description): void
    {
        static::create([
            'user_id'     => auth()->id(),
            'action'      => $action,
            'model_type'  => get_class($model),
            'model_id'    => $model->id,
            'description' => $description,
        ]);
    }

    public static function getActionLabels(): array
    {
        return array_values(self::$actionLabels);
    }

    public static function labelToAction(string $label): ?string
    {
        $flipped = array_flip(self::$actionLabels);
        return $flipped[$label] ?? null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    // Accessors for view compatibility
    public function getTitleAttribute(): string
    {
        return $this->description ?? '-';
    }

    public function getDateAttribute(): Carbon
    {
        return $this->created_at;
    }

    public function getCategoryAttribute(): string
    {
        return self::$actionLabels[$this->action] ?? ucfirst($this->action);
    }

    public function getPerformedByAttribute(): string
    {
        return $this->getStaffNameAttribute();
    }

    public function getDivisionNameAttribute(): string
    {
        return $this->user?->staff?->division?->name ?? '-';
    }

    public function getStaffNameAttribute(): string
    {
        return $this->user?->staff?->name ?? $this->user?->name ?? 'Sistem';
    }

    public function getFormattedTimeAttribute(): string
    {
        return $this->created_at->format('d M Y, H:i');
    }
}