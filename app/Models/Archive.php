<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Archive extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'arc';

    public const TYPES = [
        'general_letter' => 'Surat Umum',
        'lpj'            => 'LPJ',
        'proposal'       => 'Proposal',
        'nota'           => 'Nota',
    ];

    protected $fillable = [
        'name', 'type', 'division_id',
        'file_path', 'file_name', 'mime_type', 'file_size',
        'share_token', 'short_code', 'share_enabled', 'share_expires_at',
    ];

    protected $casts = [
        'file_size'        => 'integer',
        'share_enabled'    => 'boolean',
        'share_expires_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $archive) {
            if (empty($archive->share_token)) {
                do {
                    $token = Str::random(64);
                } while (static::where('share_token', $token)->exists());

                $archive->share_token = $token;
            }

            if (empty($archive->short_code)) {
                do {
                    $code = Str::lower(Str::random(8));
                } while (static::where('short_code', $code)->exists());

                $archive->short_code = $code;
            }
        });
    }

    /** Apakah link share saat ini aktif dan belum kadaluarsa. */
    public function isShareActive(): bool
    {
        if (! $this->share_enabled) {
            return false;
        }

        if ($this->share_expires_at && $this->share_expires_at->isPast()) {
            return false;
        }

        return true;
    }

    // -----------------------------------------------------------------------
    // Accessors
    // -----------------------------------------------------------------------

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? ucfirst((string) $this->type);
    }

    public function getDivisionNameAttribute(): string
    {
        return $this->division?->name ?? '-';
    }

    public function getFileUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    public function getShareUrlAttribute(): string
    {
        return route('archives.share', $this->share_token);
    }

    public function getShortUrlAttribute(): string
    {
        return route('archives.short', $this->short_code);
    }

    public function getQrCodeUrlAttribute(): string
    {
        $target   = urlencode($this->short_url);
        $logoUrl  = config('app.logo_qr_url', '');  // APP_LOGO_QR_URL — PNG kecil khusus QR, max ~100KB

        $logoParam = $logoUrl !== ''
            ? '&centerImageUrl=' . urlencode($logoUrl) . '&centerImageSizeRatio=0.25&ecLevel=H'
            : '';

        return "https://quickchart.io/qr?text={$target}&size=300&format=png{$logoParam}";
    }

    public function getQrDownloadUrlAttribute(): string
    {
        return $this->qr_code_url . '&download=1';
    }

    // -----------------------------------------------------------------------
    // Relations
    // -----------------------------------------------------------------------

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
