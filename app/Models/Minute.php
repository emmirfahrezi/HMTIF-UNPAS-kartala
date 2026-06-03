<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Minute extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'mnt';

    protected $fillable = [
        'division_id',
        'nomor', 'perihal', 'tanggal', 'waktu_mulai', 'waktu_selesai',
        'tempat', 'dipimpin_oleh', 'agenda', 'isi_rapat', 'dokumentasi_file',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(MinuteAttendee::class)->orderBy('order');
    }
}