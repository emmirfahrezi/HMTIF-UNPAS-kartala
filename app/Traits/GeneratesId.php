<?php

namespace app\Traits;

use Illuminate\Support\Str;

trait GeneratesId
{
    public static function bootGeneratesId(): void
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = $model->generateId();
            }
        });
    }

protected function generateId(): string
{
    $prefix = isset(static::$idPrefix) ? static::$idPrefix : 'rec';
    return $prefix . '-' . Str::random(6) . '-' . Str::random(6);
}

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}