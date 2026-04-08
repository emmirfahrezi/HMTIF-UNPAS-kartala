<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $fillable = [
        'name', 'email', 'subject', 'message',
        'tracking_code', 'status', 'is_spotlight', 'spotlighted_week',
    ];

    protected $casts = [
        'is_spotlight'    => 'boolean',
        'spotlighted_week' => 'date',
    ];
}
