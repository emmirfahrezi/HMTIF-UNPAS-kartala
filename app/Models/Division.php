<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'div';

    protected $fillable = ['name', 'slug', 'abbreviation', 'description', 'order'];

    /** Apakah divisi ini adalah BPH (Badan Pengurus Harian). */
    public function isBph(): bool
    {
        return $this->slug === 'bph'
            || strtolower($this->name) === 'badan pengurus harian';
    }

    /**
     * Daftar peran yang ditampilkan di halaman detail divisi.
     * Mengambil dari config hmtif sesuai tipe divisi.
     *
     * @return array<int, array{title: string, desc: string, icon: string}>
     */
    public function getRolesToShowAttribute(): array
    {
        return $this->isBph()
            ? config('hmtif.bph_roles')
            : config('hmtif.division_roles');
    }

    public function staffs(): HasMany
    {
        return $this->hasMany(Staff::class);
    }
}