<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, GeneratesId;

    protected static string $idPrefix = 'usr';

    public function isAdmin(): bool       { return $this->role === 'admin'; }
    public function isBph(): bool         { return in_array($this->role, ['admin', 'bph']); }
    public function isKoordinator(): bool { return in_array($this->role, ['admin', 'bph', 'koordinator']); }

    protected $fillable = [
        'name', 'email', 'password', 'role', 'staff_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}