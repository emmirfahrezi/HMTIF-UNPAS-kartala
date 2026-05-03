<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'log';

    protected $fillable = [
        'title', 'description', 'date', 'category', 'performed_by',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}