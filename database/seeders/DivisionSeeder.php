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
                'name'         => 'Badan Pengurus Harian',
                'slug'         => 'bph',
                'abbreviation' => 'BPH',
                'description'  => 'Badan inti pelaksana organisasi yang bertanggung jawab atas keseluruhan kepengurusan HMTIF UNPAS Kabinet Kartala.',
                'order'        => 0,
            ],
            [
                'name'         => 'Kajian Strategis & Advokasi',
                'slug'         => 'kastrad',
                'abbreviation' => 'KASTRAD',
                'description'  => 'Bidang yang bergerak dalam kajian isu strategis, advokasi mahasiswa, dan pengawalan kebijakan akademik.',
                'order'        => 1,
            ],
            [
                'name'         => 'Komunikasi & Informasi',
                'slug'         => 'kominfo',
                'abbreviation' => 'KOMINFO',
                'description'  => 'Bidang yang mengelola media komunikasi, publikasi konten, dan penyebaran informasi organisasi.',
                'order'        => 2,
            ],
            [
                'name'         => 'Kreatif & Ekonomi',
                'slug'         => 'keskraf',
                'abbreviation' => 'KESKRAF',
                'description'  => 'Bidang yang bertanggung jawab atas kegiatan ekonomi kreatif, niaga himpunan, dan produk merchandise.',
                'order'        => 3,
            ],
            [
                'name'         => 'Pengembangan SDM',
                'slug'         => 'psdm',
                'abbreviation' => 'PSDM',
                'description'  => 'Bidang yang fokus pada pengembangan kompetensi, pelatihan, dan kualitas sumber daya manusia anggota himpunan.',
                'order'        => 4,
            ],
            [
                'name'         => 'Peminat & Bakat',
                'slug'         => 'pmb',
                'abbreviation' => 'PMB',
                'description'  => 'Bidang yang memfasilitasi minat dan bakat anggota melalui kegiatan olahraga, seni, dan kompetisi.',
                'order'        => 5,
            ],
        ];

        foreach ($divisions as $division) {
            Division::updateOrCreate(['slug' => $division['slug']], $division);
        }
    }
}
