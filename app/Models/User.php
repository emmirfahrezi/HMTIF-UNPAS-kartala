<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, GeneratesId;

    protected static string $idPrefix = 'usr';

    /** Daftar role untuk form (value => label singkat). */
    public const ROLES = [
        'admin'       => 'Admin',
        'bph'         => 'BPH',
        'koordinator' => 'Koordinator',
        'staff'       => 'Staff',
    ];

    /**
     * Label role untuk tampilan UI dashboard (lebih deskriptif).
     * 'admin' ditampilkan sebagai 'Superadmin' di topbar/sidebar.
     */
    public const ROLE_LABELS = [
        'admin'       => 'Superadmin',
        'bph'         => 'BPH',
        'koordinator' => 'Koordinator',
        'staff'       => 'Staff',
    ];

    public function isAdmin(): bool       { return $this->role === 'admin'; }
    public function isBph(): bool         { return in_array($this->role, ['admin', 'bph']); }
    public function isKoordinator(): bool { return in_array($this->role, ['admin', 'bph', 'koordinator']); }

    protected $fillable = [
        'email', 'password', 'role', 'staff_id', 'photo',
    ];

    public function getNameAttribute(): string
    {
        return $this->staff?->name ?? $this->email;
    }

    /** Label role untuk ditampilkan di UI (misal: "Superadmin", "BPH"). */
    public function getRoleLabelAttribute(): string
    {
        return self::ROLE_LABELS[$this->role ?? ''] ?? ucfirst((string) ($this->role ?? ''));
    }

    /**
     * Inisial satu huruf untuk avatar/topbar.
     * Diambil dari huruf pertama nama, fallback ke 'A'.
     */
    public function getInitialAttribute(): string
    {
        return strtoupper(substr($this->name, 0, 1) ?: 'A');
    }

    /**
     * URL lengkap foto profil user.
     *
     * Prioritas:
     * 1. users.photo (foto yang di-set langsung di profil dashboard).
     * 2. staff.photo (foto dari data pengurus terhubung).
     * 3. Fallback ke avatar DiceBear (SVG) dengan seed = nama user.
     */
    public function getAvatarUrlAttribute(): string
    {
        $photo = (string) ($this->photo ?? $this->staff?->photo ?? '');

        if ($photo !== '') {
            return \media_url($photo, 'images/placeholders/member.svg');
        }

        return 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . urlencode($this->name);
    }

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