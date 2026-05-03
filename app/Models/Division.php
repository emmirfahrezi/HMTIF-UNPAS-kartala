<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'div';

    protected $fillable = ['name', 'slug', 'description', 'order'];

    public function staffs(): HasMany
    {
        return $this->hasMany(Staff::class);
    }
}