<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'act';

    protected $fillable = [
        'title', 'slug', 'description', 'body', 'thumbnail', 'file',
        'start_date', 'end_date', 'location', 'registration_url', 'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];
}