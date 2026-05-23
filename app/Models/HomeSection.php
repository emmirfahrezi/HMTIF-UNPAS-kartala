<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'hms';

    protected $fillable = ['section', 'key', 'value', 'order'];

    public static function get(string $section, string $key, mixed $default = null): mixed
    {
        return static::where('section', $section)
            ->where('key', $key)
            ->value('value') ?? $default;
    }

    public static function set(string $section, string $key, mixed $value, int $order = 0): void
    {
        static::updateOrCreate(
            ['section' => $section, 'key' => $key],
            ['value' => $value, 'order' => $order]
        );
    }

    public static function getSection(string $section): array
    {
        return static::where('section', $section)
            ->orderBy('order')
            ->pluck('value', 'key')
            ->toArray();
    }

    /**
     * Parse teks misi dari DB (bisa berupa HTML atau plain text) menjadi array string.
     *
     * Mendukung dua format input:
     * 1. HTML dengan tag <p> atau <li> — tiap tag jadi satu item misi
     * 2. Plain text — dipisah per baris (newline)
     *
     * Jika hasilnya kosong, kembalikan misi fallback default.
     *
     * @return string[]
     */
    public static function parseMissions(string $missionText): array
    {
        if (trim($missionText) === '') {
            return static::defaultMissions();
        }

        // Format HTML: ambil konten dalam <p> atau <li>
        if (str_contains($missionText, '<p>') || str_contains($missionText, '<li>')) {
            preg_match_all('/(?:<p>|<li>)(.*?)(?:<\/p>|<\/li>)/is', $missionText, $matches);
            $missions = array_filter(array_map('strip_tags', $matches[1] ?? []));

            if (! empty($missions)) {
                return array_values($missions);
            }
        }

        // Format plain text: pisah per baris
        $missions = array_filter(
            array_map('trim', explode("\n", strip_tags($missionText)))
        );

        return ! empty($missions)
            ? array_values($missions)
            : static::defaultMissions();
    }

    /**
     * Misi default yang ditampilkan jika belum ada data di database.
     *
     * @return string[]
     */
    public static function defaultMissions(): array
    {
        return [
            'Menyelenggarakan kegiatan akademis dan non-akademis yang inovatif guna meningkatkan kompetensi mahasiswa Teknik Informatika.',
            'Membangun budaya kolaborasi yang harmonis dan aktif baik di internal himpunan maupun eksternal kampus.',
            'Menyediakan wadah aspirasi yang responsif, solutif, dan transparan untuk seluruh civitas akademika Teknik Informatika UNPAS.',
        ];
    }
}