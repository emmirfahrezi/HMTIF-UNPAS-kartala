<?php

namespace Database\Seeders;

use App\Models\HomeSection;
use Illuminate\Database\Seeder;

class HomeSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            // Hero
            ['section' => 'hero', 'key' => 'title',            'value' => 'HMTIF UNPAS',                                     'order' => 1],
            ['section' => 'hero', 'key' => 'tagline',          'value' => 'Selamat Datang di Portal Resmi HMTIF UNPAS',       'order' => 2],
            ['section' => 'hero', 'key' => 'description',      'value' => 'Membangun harmoni, menginspirasi perubahan, dan mewujudkan Teknik Informatika yang lebih progresif melalui dedikasi dan kerja nyata.', 'order' => 3],
            ['section' => 'hero', 'key' => 'btn_primary',      'value' => 'Jelajahi Program',                                 'order' => 4],
            ['section' => 'hero', 'key' => 'btn_secondary',    'value' => 'Tentang Kami',                                    'order' => 5],
            ['section' => 'hero', 'key' => 'background_image', 'value' => '',                                                 'order' => 6],

            // Identitas & Harapan
            ['section' => 'identity', 'key' => 'title',       'value' => 'Identitas & Harapan',                             'order' => 1],
            ['section' => 'identity', 'key' => 'subtitle',    'value' => 'Himpunan Mahasiswa Teknik Informatika UNPAS',      'order' => 2],
            ['section' => 'identity', 'key' => 'description', 'value' => 'HMTIF Universitas Pasundan bukan sekadar organisasi mahasiswa. Kami adalah laboratorium kehidupan, tempat di mana setiap mahasiswa Teknik Informatika menemukan potensi terbaiknya melalui kolaborasi, riset, dan semangat kekeluargaan yang telah terjaga selama puluhan tahun.', 'order' => 3],
            ['section' => 'identity', 'key' => 'point_1_title', 'value' => 'Pusat Riset',                                   'order' => 4],
            ['section' => 'identity', 'key' => 'point_1_desc',  'value' => 'Mengembangkan solusi teknologi inovatif.',      'order' => 5],
            ['section' => 'identity', 'key' => 'point_2_title', 'value' => 'Wadah Solutif',                                 'order' => 6],
            ['section' => 'identity', 'key' => 'point_2_desc',  'value' => 'Menampung aspirasi setiap anggota.',            'order' => 7],
            ['section' => 'identity', 'key' => 'image',          'value' => '',                                              'order' => 8],

            // Era Baru: Kartala
            ['section' => 'era', 'key' => 'label',       'value' => 'Era Baru: Kartala',                                    'order' => 1],
            ['section' => 'era', 'key' => 'title',       'value' => 'HARMONI DALAM PERGERAKAN NYATA',                       'order' => 2],
            ['section' => 'era', 'key' => 'description', 'value' => 'Di bawah semangat HMTIF UNPAS, kami berkomitmen untuk menghadirkan perubahan yang progresif. Kartala bukan hanya soal nama, tapi soal bagaimana kami membangun harmoni di tengah keberagaman, menginspirasi melalui dedikasi, dan mengeksekusi setiap program kerja dengan presisi.', 'order' => 3],
            ['section' => 'era', 'key' => 'image',       'value' => '',                                                      'order' => 4],

            // Visi & Misi
            ['section' => 'vision_mission', 'key' => 'label',       'value' => 'Arah Gerak Organisasi',                    'order' => 1],
            ['section' => 'vision_mission', 'key' => 'title',       'value' => 'Visi & Misi HMTIF',                        'order' => 2],
            ['section' => 'vision_mission', 'key' => 'description', 'value' => 'Fondasi nilai yang membentuk cara kami berpikir, bergerak, dan berkontribusi untuk mahasiswa Teknik Informatika UNPAS.', 'order' => 3],
            ['section' => 'vision_mission', 'key' => 'vision_title',  'value' => 'Visi Utama',                             'order' => 4],
            ['section' => 'vision_mission', 'key' => 'vision_text',   'value' => 'Mewujudkan HMTIF UNPAS sebagai organisasi yang adaptif, edukatif, dan inspiratif dalam membangun harmoni serta kemajuan Teknik Informatika.', 'order' => 5],
            ['section' => 'vision_mission', 'key' => 'vision_tagline','value' => 'VISION FIRST, IMPACT FOLLOWS',           'order' => 6],
            ['section' => 'vision_mission', 'key' => 'mission_title', 'value' => 'Misi Strategis',                         'order' => 7],
            ['section' => 'vision_mission', 'key' => 'mission_text',  'value' => '',                                        'order' => 8],
            ['section' => 'vision_mission', 'key' => 'vision_type',   'value' => 'text',                                    'order' => 9],
            ['section' => 'vision_mission', 'key' => 'mission_type',  'value' => 'points',                                  'order' => 10],

            // Stats section header
            ['section' => 'stats', 'key' => 'label',       'value' => 'Pergerakan Kami',                                   'order' => 1],
            ['section' => 'stats', 'key' => 'title',       'value' => 'Kekuatan Kolektif HMTIF UNPAS',                     'order' => 2],
            ['section' => 'stats', 'key' => 'description', 'value' => 'Melalui semangat "Kartala", kami bergerak bersama untuk menghadirkan perubahan nyata melalui program kerja yang terukur.', 'order' => 3],
        ];

        foreach ($sections as $data) {
            HomeSection::updateOrCreate(
                ['section' => $data['section'], 'key' => $data['key']],
                ['value' => $data['value'], 'order' => $data['order']]
            );
        }
    }
}