<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'hms';

    protected $fillable = ['section', 'key', 'value', 'order'];

    public static function get(string $section, string $key, mixed $default = null): mixed
    {
        return static::where('section', $section)
            ->where('key', $key)
            ->value('value') ?? $default;
    }

    public static function set(string $section, string $key, mixed $value, int $order = 0): void
    {
        static::updateOrCreate(
            ['section' => $section, 'key' => $key],
            ['value' => $value, 'order' => $order]
        );
    }

    public static function getSection(string $section): array
    {
        return static::where('section', $section)
            ->orderBy('order')
            ->pluck('value', 'key')
            ->toArray();
    }
}