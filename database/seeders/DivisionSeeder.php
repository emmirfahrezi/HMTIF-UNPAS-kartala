<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            [
                'name'        => 'Badan Pengurus Harian',
                'slug'        => 'bph',
                'description' => 'Badan inti pelaksana organisasi yang bertanggung jawab atas keseluruhan kepengurusan HMTIF UNPAS Kabinet Kartala.',
                'order'       => 0,
            ],
            [
                'name'        => 'Kajian Strategis & Advokasi',
                'slug'        => 'kastrad',
                'description' => 'Bidang yang bergerak dalam kajian isu strategis, advokasi mahasiswa, dan pengawalan kebijakan akademik.',
                'order'       => 1,
            ],
            [
                'name'        => 'Komunikasi & Informasi',
                'slug'        => 'kominfo',
                'description' => 'Bidang yang mengelola media komunikasi, publikasi konten, dan penyebaran informasi organisasi.',
                'order'       => 2,
            ],
            [
                'name'        => 'Kreatif & Ekonomi',
                'slug'        => 'keskraf',
                'description' => 'Bidang yang bertanggung jawab atas kegiatan ekonomi kreatif, niaga himpunan, dan produk merchandise.',
                'order'       => 3,
            ],
            [
                'name'        => 'Pengembangan SDM',
                'slug'        => 'psdm',
                'description' => 'Bidang yang fokus pada pengembangan kompetensi, pelatihan, dan kualitas sumber daya manusia anggota himpunan.',
                'order'       => 4,
            ],
            [
                'name'        => 'Peminat & Bakat',
                'slug'        => 'pmb',
                'description' => 'Bidang yang memfasilitasi minat dan bakat anggota melalui kegiatan olahraga, seni, dan kompetisi.',
                'order'       => 5,
            ],
        ];

        foreach ($divisions as $division) {
            Division::updateOrCreate(['slug' => $division['slug']], $division);
        }
    }
}
