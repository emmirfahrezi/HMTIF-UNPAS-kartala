<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'stf';
    protected $table = 'staffs';

    /** Jabatan yang termasuk pimpinan himpunan (Ketua Umum). */
    public const LEADER_POSITIONS = ['Ketua Himpunan', 'Ketua Umum'];

    /**
     * Singkatan jabatan untuk kartu anggota BPH.
     * Key: nama jabatan (huruf kecil tidak diperlukan, match exact).
     */
    public const DEPT_ABBREVIATIONS = [
        'Ketua Umum'             => 'KET',
        'Sekretaris Jenderal'    => 'SEKJEN',
        'Sekretaris Umum'        => 'SEKUM',
        'Wakil Sekretaris Umum'  => 'WASEKUM',
        'Bendahara Umum'         => 'BEND',
        'Wakil Bendahara Umum'   => 'WABEND',
        'Kepala Bidang 1'        => 'KAB 1',
        'Kepala Bidang 2'        => 'KAB 2',
    ];

    protected $fillable = [
        'division_id', 'name', 'position', 'photo', 'bio',
        'instagram', 'linkedin', 'order', 'is_active', 'is_bph',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_bph'    => 'boolean',
        'order'     => 'integer',
    ];

    /** Apakah jabatan ini termasuk pimpinan himpunan. */
    public function isLeader(): bool
    {
        return \in_array($this->position, self::LEADER_POSITIONS, true);
    }

    /**
     * Singkatan jabatan untuk ditampilkan di kartu anggota.
     * Jika tidak ditemukan di konstanta, fallback ke singkatan divisi.
     */
    public function getAbbreviationAttribute(): string
    {
        return self::DEPT_ABBREVIATIONS[$this->position]
            ?? ($this->division?->abbreviationCode ?? 'BPH');
    }

    public function getPhotoUrlAttribute(): string
    {
        return media_url($this->photo, 'images/placeholders/member.svg');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}