<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Period;
use App\Models\Staff;
use App\Models\StaffPeriod;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $bph    = Division::where('slug', 'bph')->first();
        $kastrad = Division::where('slug', 'kastrad')->first();
        $kominfo = Division::where('slug', 'kominfo')->first();
        $keskraf = Division::where('slug', 'keskraf')->first();
        $psdm   = Division::where('slug', 'psdm')->first();
        $pmb    = Division::where('slug', 'pmb')->first();

        $staffs = [
            // BPH - Pimpinan Utama (is_bph = true)
            [
                'division_id' => $bph->id,
                'name'        => 'Fahreza Fauzan',
                'position'    => 'Ketua Himpunan',
                'photo'       => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=600&auto=format&fit=crop',
                'bio'         => 'Memimpin HMTIF UNPAS Kabinet Kartala dengan semangat kolaborasi dan inovasi untuk kemajuan Informatika.',
                'instagram'   => '@fahreza.fauzan',
                'order'       => 1,
                'is_active'   => true,
                'is_bph'      => true,
            ],
            [
                'division_id' => $bph->id,
                'name'        => 'Ahmad Jaelani',
                'position'    => 'Sekretaris Jenderal',
                'photo'       => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=600&auto=format&fit=crop',
                'bio'         => 'Bertanggung jawab atas koordinasi antar bidang dan pengarsipan organisasi.',
                'instagram'   => '@ahmad.jaelani',
                'order'       => 2,
                'is_active'   => true,
                'is_bph'      => true,
            ],
            [
                'division_id' => $bph->id,
                'name'        => 'Siti Nurhaliza',
                'position'    => 'Sekretaris Umum',
                'photo'       => null,
                'bio'         => 'Mengelola administrasi dan surat menyurat resmi HMTIF.',
                'instagram'   => '@siti.nurhaliza',
                'order'       => 3,
                'is_active'   => true,
                'is_bph'      => true,
            ],
            [
                'division_id' => $bph->id,
                'name'        => 'Lestari Putri',
                'position'    => 'Bendahara Umum',
                'photo'       => null,
                'bio'         => 'Mengelola keuangan dan anggaran kegiatan himpunan.',
                'instagram'   => '@lestari.putri',
                'order'       => 4,
                'is_active'   => true,
                'is_bph'      => true,
            ],
            [
                'division_id' => $bph->id,
                'name'        => 'Randi Kurnia',
                'position'    => 'Wakil Sekretaris Umum',
                'photo'       => null,
                'bio'         => 'Membantu Sekretaris Umum dalam pengelolaan administrasi.',
                'instagram'   => '@randi.kurnia',
                'order'       => 5,
                'is_active'   => true,
                'is_bph'      => true,
            ],
            [
                'division_id' => $bph->id,
                'name'        => 'Dedi Wijaya',
                'position'    => 'Wakil Bendahara Umum',
                'photo'       => null,
                'bio'         => 'Membantu Bendahara Umum dalam pengelolaan keuangan.',
                'instagram'   => '@dedi.wijaya',
                'order'       => 6,
                'is_active'   => true,
                'is_bph'      => true,
            ],

            // KASTRAD
            [
                'division_id' => $kastrad->id,
                'name'        => 'Rizky Aditya',
                'position'    => 'Koordinator KASTRAD',
                'photo'       => 'https://images.unsplash.com/photo-1519085185750-74071727339a?q=80&w=400&auto=format&fit=crop',
                'bio'         => 'Memimpin kajian strategis dan advokasi kebijakan mahasiswa Teknik Informatika.',
                'instagram'   => '@rizky.aditya',
                'order'       => 1,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $kastrad->id,
                'name'        => 'Dewi Rahayu',
                'position'    => 'Anggota KASTRAD',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@dewi.rahayu',
                'order'       => 2,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $kastrad->id,
                'name'        => 'Andi Prasetyo',
                'position'    => 'Anggota KASTRAD',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@andi.prasetyo',
                'order'       => 3,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $kastrad->id,
                'name'        => 'Nadia Permata',
                'position'    => 'Anggota KASTRAD',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@nadia.permata',
                'order'       => 4,
                'is_active'   => true,
                'is_bph'      => false,
            ],

            // KOMINFO
            [
                'division_id' => $kominfo->id,
                'name'        => 'Bima Sakti',
                'position'    => 'Koordinator KOMINFO',
                'photo'       => 'https://images.unsplash.com/photo-1519085185750-74071727339a?q=80&w=400&auto=format&fit=crop',
                'bio'         => 'Mengelola seluruh kanal informasi dan komunikasi publik HMTIF UNPAS.',
                'instagram'   => '@bima.sakti',
                'order'       => 1,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $kominfo->id,
                'name'        => 'Cantika Sari',
                'position'    => 'Anggota KOMINFO',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@cantika.sari',
                'order'       => 2,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $kominfo->id,
                'name'        => 'Gilang Ramadhan',
                'position'    => 'Anggota KOMINFO',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@gilang.ramadhan',
                'order'       => 3,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $kominfo->id,
                'name'        => 'Hana Fitriani',
                'position'    => 'Anggota KOMINFO',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@hana.fitriani',
                'order'       => 4,
                'is_active'   => true,
                'is_bph'      => false,
            ],

            // KESKRAF
            [
                'division_id' => $keskraf->id,
                'name'        => 'Ivan Susanto',
                'position'    => 'Koordinator KESKRAF',
                'photo'       => 'https://images.unsplash.com/photo-1519085185750-74071727339a?q=80&w=400&auto=format&fit=crop',
                'bio'         => 'Memimpin bidang ekonomi kreatif dan niaga himpunan.',
                'instagram'   => '@ivan.susanto',
                'order'       => 1,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $keskraf->id,
                'name'        => 'Julia Ananda',
                'position'    => 'Anggota KESKRAF',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@julia.ananda',
                'order'       => 2,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $keskraf->id,
                'name'        => 'Kevin Pratama',
                'position'    => 'Anggota KESKRAF',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@kevin.pratama',
                'order'       => 3,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $keskraf->id,
                'name'        => 'Laras Wening',
                'position'    => 'Anggota KESKRAF',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@laras.wening',
                'order'       => 4,
                'is_active'   => true,
                'is_bph'      => false,
            ],

            // PSDM
            [
                'division_id' => $psdm->id,
                'name'        => 'Muhammad Fauzi',
                'position'    => 'Koordinator PSDM',
                'photo'       => 'https://images.unsplash.com/photo-1519085185750-74071727339a?q=80&w=400&auto=format&fit=crop',
                'bio'         => 'Memimpin pengembangan kompetensi dan kaderisasi anggota himpunan.',
                'instagram'   => '@m.fauzi',
                'order'       => 1,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $psdm->id,
                'name'        => 'Nisa Oktaviani',
                'position'    => 'Anggota PSDM',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@nisa.oktaviani',
                'order'       => 2,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $psdm->id,
                'name'        => 'Omar Hidayat',
                'position'    => 'Anggota PSDM',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@omar.hidayat',
                'order'       => 3,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $psdm->id,
                'name'        => 'Putri Maharani',
                'position'    => 'Anggota PSDM',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@putri.maharani',
                'order'       => 4,
                'is_active'   => true,
                'is_bph'      => false,
            ],

            // PMB
            [
                'division_id' => $pmb->id,
                'name'        => 'Qori Ramadhan',
                'position'    => 'Koordinator PMB',
                'photo'       => 'https://images.unsplash.com/photo-1519085185750-74071727339a?q=80&w=400&auto=format&fit=crop',
                'bio'         => 'Memimpin fasilitas pengembangan minat dan bakat mahasiswa Teknik Informatika.',
                'instagram'   => '@qori.ramadhan',
                'order'       => 1,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $pmb->id,
                'name'        => 'Riska Amelia',
                'position'    => 'Anggota PMB',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@riska.amelia',
                'order'       => 2,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $pmb->id,
                'name'        => 'Surya Dharma',
                'position'    => 'Anggota PMB',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@surya.dharma',
                'order'       => 3,
                'is_active'   => true,
                'is_bph'      => false,
            ],
            [
                'division_id' => $pmb->id,
                'name'        => 'Tiara Kusuma',
                'position'    => 'Anggota PMB',
                'photo'       => null,
                'bio'         => null,
                'instagram'   => '@tiara.kusuma',
                'order'       => 4,
                'is_active'   => true,
                'is_bph'      => false,
            ],
        ];

        $period = Period::where('label', '2025/2026')->first();

        foreach ($staffs as $data) {
            $staff = Staff::updateOrCreate(
                ['name' => $data['name'], 'division_id' => $data['division_id']],
                $data
            );

            if ($period) {
                StaffPeriod::updateOrCreate(
                    ['period_id' => $period->id, 'staff_id' => $staff->id],
                    [
                        'division_id' => $data['division_id'],
                        'position'    => $data['position'],
                        'order'       => $data['order'],
                        'is_bph'      => $data['is_bph'],
                        'is_active'   => $data['is_active'],
                    ]
                );
            }
        }
    }
}
