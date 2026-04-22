<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Minute extends Model
{
    protected $fillable = [
        'nomor',
        'perihal',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'tempat',
        'dipimpin_oleh',
        'agenda',
        'isi_rapat',
        'dokumentasi_file',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function attendees(): HasMany
    {
        return $this->hasMany(MinuteAttendee::class)->orderBy('order');
    }
}
