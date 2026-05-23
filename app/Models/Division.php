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

    /**
     * Pemetaan nama divisi (huruf kecil) ke kode singkatan.
     * Dipakai sebagai fallback jika kolom `abbreviation` di DB kosong.
     */
    public const ABBREVIATIONS = [
        'kajian strategis dan advokasi'    => 'KASTRAD',
        'komunikasi dan informasi'         => 'KOMINFO',
        'pengembangan sumber daya mahasiswa' => 'PSDM',
        'minat dan bakat'                  => 'PMB',
        'kewirausahaan kreatif'            => 'KESKRAF',
        'badan pengurus harian'            => 'BPH',
    ];

    /** Apakah divisi ini adalah BPH (Badan Pengurus Harian). */
    public function isBph(): bool
    {
        return $this->slug === 'bph'
            || strtolower($this->name) === 'badan pengurus harian';
    }

    /**
     * Kode singkatan divisi untuk ditampilkan di kartu anggota.
     * Prioritas: kolom abbreviation di DB → konstanta ABBREVIATIONS → 6 karakter pertama slug.
     */
    public function getAbbreviationCodeAttribute(): string
    {
        if (! empty($this->abbreviation)) {
            return strtoupper($this->abbreviation);
        }

        return self::ABBREVIATIONS[strtolower($this->name)]
            ?? strtoupper(substr($this->slug, 0, 6));
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