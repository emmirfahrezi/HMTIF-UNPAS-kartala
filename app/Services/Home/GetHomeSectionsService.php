<?php

namespace App\Services\Home;

use App\Models\HomeSection;

class GetHomeSectionsService
{
    /**
     * Ambil semua data home sections yang dikelompokkan per section.
     *
     * Hasil berupa nested array:
     * [
     *   'hero'           => ['title' => '...', 'tagline' => '...', ...],
     *   'identity'       => ['title' => '...', 'subtitle' => '...', ...],
     *   'era'            => ['label' => '...', 'title' => '...', ...],
     *   'vision_mission' => ['label' => '...', ..., 'missions' => [...]],
     *   'stats'          => ['label' => '...', 'title' => '...', ...],
     * ]
     *
     * Struktur ini kompatibel dengan data_get($homeSections, 'hero.tagline', 'fallback')
     * yang digunakan di komponen Blade hero, about, stats, dan vision-mission.
     *
     * @return array<string, array<string, mixed>>
     */
    public function execute(): array
    {
        $rows = HomeSection::orderBy('order')->get();

        $sections = [];
        foreach ($rows as $row) {
            $sections[$row->section][$row->key] = $row->value;
        }

        // Parse teks misi menjadi array siap pakai sehingga blade tidak perlu parsing sendiri
        $missionText = $sections['vision_mission']['mission_text'] ?? '';
        $sections['vision_mission']['missions'] = HomeSection::parseMissions($missionText);

        return $sections;
    }
}
