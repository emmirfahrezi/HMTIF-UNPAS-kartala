<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'can_create',
        'can_read',
        'can_update',
        'can_delete',
        'menu_access',
    ];

    protected $casts = [
        'can_create'  => 'boolean',
        'can_read'    => 'boolean',
        'can_update'  => 'boolean',
        'can_delete'  => 'boolean',
        'menu_access' => 'array',
    ];
}
