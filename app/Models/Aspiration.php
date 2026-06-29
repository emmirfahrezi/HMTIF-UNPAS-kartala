<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'asp';

    /**
     * Status aspirasi beserta label dan nomor langkah progres.
     * Urutan array menentukan urutan timeline di frontend.
     */
    public const STATUSES = [
        'pending'  => ['label' => 'Aspirasi Masuk',  'step' => 1],
        'reviewed' => ['label' => 'Sedang Diproses',  'step' => 2],
        'resolved' => ['label' => 'Selesai',           'step' => 3],
        'rejected' => ['label' => 'Ditolak',           'step' => 0],
    ];

    protected $fillable = [
        'name', 'nim', 'email', 'subject', 'message',
        'tracking_code', 'status',
    ];

    // -----------------------------------------------------------------------
    // Accessors
    // -----------------------------------------------------------------------

    /** Label status dalam Bahasa Indonesia. */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status]['label'] ?? ucfirst((string) $this->status);
    }

    /** Nomor langkah progres (1–3) untuk timeline di frontend. */
    public function getStatusStepAttribute(): int
    {
        return self::STATUSES[$this->status]['step'] ?? 0;
    }

    /** Kelas Tailwind untuk badge status. */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'bg-black/30 border border-secondary-soft/30 text-secondary-soft shadow-[0_4px_20px_rgba(0,0,0,0.15)]',
            'reviewed' => 'bg-black/30 border border-primary-soft/30 text-primary-soft shadow-[0_4px_20px_rgba(0,0,0,0.15)]',
            'resolved' => 'bg-black/30 border border-white/20 text-white shadow-[0_4px_20px_rgba(0,0,0,0.15)]',
            default    => 'bg-black/30 border border-white/10 text-white',
        };
    }

    /** Kelas Tailwind untuk titik (dot) indikator status. */
    public function getStatusDotColorAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'bg-secondary-soft',
            'reviewed' => 'bg-primary-soft',
            'resolved' => 'bg-white',
            default    => 'bg-white',
        };
    }

    /** Kelas Tailwind untuk badge status di dashboard (light/dark aware). */
    public function getStatusColorClassAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400',
            'reviewed' => 'bg-sky-500/10 border border-sky-500/20 text-sky-600 dark:text-sky-400',
            'resolved' => 'bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400',
            'rejected' => 'bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400',
            default    => 'bg-slate-500/10 border border-slate-500/20 text-slate-600 dark:text-slate-400',
        };
    }

    /**
     * Pesan default dari tim advokasi ketika belum ada feedback manual.
     * Ditampilkan di halaman tracking publik.
     */
    public function getDefaultFeedbackMessageAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'Menunggu tim advokasi meninjau aspirasimu. Kami akan segera memprosesnya.',
            'reviewed' => 'Aspirasi kamu sedang dalam tahap koordinasi dengan departemen terkait. Terima kasih atas kesabarannya.',
            'resolved' => 'Aspirasi ini telah selesai ditindaklanjuti. Terima kasih telah berkontribusi.',
            'rejected' => 'Aspirasi ini tidak dapat ditindaklanjuti. Silakan hubungi tim advokasi untuk informasi lebih lanjut.',
            default    => '',
        };
    }
}