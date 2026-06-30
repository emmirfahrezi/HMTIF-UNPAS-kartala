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
        $bph     = Division::where('slug', 'bph')->first();
        $kastrad = Division::where('slug', 'kastrad')->first();
        $kominfo = Division::where('slug', 'kominfo')->first();
        $keskraf = Division::where('slug', 'keskraf')->first();
        $psdm    = Division::where('slug', 'psdm')->first();
        $pmb     = Division::where('slug', 'pmb')->first();

        $staffs = [
            // ── BPH ──────────────────────────────────────────────────────────
            ['division_id' => $bph->id, 'name' => 'Ali Imran Rodja',                 'npm' => '223040003', 'position' => 'Ketua Umum',             'order' => 1, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Fakih Helmi Maulana',             'npm' => '223040056', 'position' => 'Sekretaris Jenderal',    'order' => 2, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Aldi Pradana Hakim',              'npm' => '223040035', 'position' => 'Sekretaris Umum',        'order' => 3, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Maelani Ningrum',                 'npm' => '233040164', 'position' => 'Wakil Sekretaris Umum',  'order' => 4, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Muhammad Rizqi Saputra',          'npm' => '223040104', 'position' => 'Bendahara Umum',         'order' => 5, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Dera Triyadi Fatimah',            'npm' => '233040146', 'position' => 'Wakil Bendahara Umum',   'order' => 6, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Athaillah Sulthan Firasyal Ilmi', 'npm' => '233040102', 'position' => 'Kepala Bidang I',        'order' => 7, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Ilham Ramadhana Hartono',         'npm' => '223040013', 'position' => 'Kepala Bidang II',       'order' => 8, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],

            // ── KASTRAD ───────────────────────────────────────────────────────
            ['division_id' => $kastrad->id, 'name' => 'Meutuah Dicco Linge',              'npm' => '223040098', 'position' => 'Koordinator Bidang', 'order' => 1,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Zaki Ramadhan Wijaya',             'npm' => '233040053', 'position' => 'Staf Bidang',        'order' => 2,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Icha Aprilia Putri',               'npm' => '233040108', 'position' => 'Staf Bidang',        'order' => 3,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Allkhanidr Cavisya Gedalzi',       'npm' => '243040001', 'position' => 'Staf Bidang',        'order' => 4,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Dion Marshall Avalon Adhiseputro', 'npm' => '243040030', 'position' => 'Staf Bidang',        'order' => 5,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Fadli Muhammad Rahmatinata',       'npm' => '243040042', 'position' => 'Staf Bidang',        'order' => 6,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Zildan Majid Aminuddin',           'npm' => '243040065', 'position' => 'Staf Bidang',        'order' => 7,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Vicka Aulia Shafira Nurwina',      'npm' => '243040067', 'position' => 'Staf Bidang',        'order' => 8,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Banyu Biankca Ardansyah',          'npm' => '243040085', 'position' => 'Staf Bidang',        'order' => 9,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Adriel Reihansyah Setiawan',       'npm' => '243040091', 'position' => 'Staf Bidang',        'order' => 10, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Afsal Prima Maula',                'npm' => '243040092', 'position' => 'Staf Bidang',        'order' => 11, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Ikmal Nurazis',                    'npm' => '243040123', 'position' => 'Staf Bidang',        'order' => 12, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],

            // ── KOMINFO ───────────────────────────────────────────────────────
            ['division_id' => $kominfo->id, 'name' => 'Kresna Satria Dewantoro',    'npm' => '233040001', 'position' => 'Koordinator Bidang', 'order' => 1, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Alfi Mifta Nurhakim',        'npm' => '233040013', 'position' => 'Staf Bidang',        'order' => 2, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => 'Backend Developer Tim Pengembang Website HMTIF-UNPAS Kabinet Kartala.',   'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Aufa Ramadhan',              'npm' => '233040028', 'position' => 'Staf Bidang',        'order' => 3, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => 'Frontend Developer Tim Pengembang Website HMTIF-UNPAS Kabinet Kartala.', 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Emmir Fahrezi',              'npm' => '233040054', 'position' => 'Staf Bidang',        'order' => 4, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Andyka Khaerulana',          'npm' => '233040072', 'position' => 'Staf Bidang',        'order' => 5, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Arya Raihan Hanif',          'npm' => '233040101', 'position' => 'Staf Bidang',        'order' => 6, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Valdric Abirama Pranaja Dandi', 'npm' => '233040163', 'position' => 'Staf Bidang',    'order' => 7, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Nasywa Nur Afiffah Salma',   'npm' => '243040033', 'position' => 'Staf Bidang',        'order' => 8, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Salma Az Zahra',             'npm' => '243040107', 'position' => 'Staf Bidang',        'order' => 9, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],

            // ── KESKRAF ───────────────────────────────────────────────────────
            ['division_id' => $keskraf->id, 'name' => 'Rama Sadea Putra',           'npm' => '233040122', 'position' => 'Koordinator Bidang', 'order' => 1, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Daniel Satya Ramadhan',      'npm' => '223040011', 'position' => 'Staf Bidang',        'order' => 2, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'George Frederik Pingak',     'npm' => '223040080', 'position' => 'Staf Bidang',        'order' => 3, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Mahesa Rahdintyo Muhammad',  'npm' => '223040162', 'position' => 'Staf Bidang',        'order' => 4, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Muhammad Aditya Prahaz',     'npm' => '243040096', 'position' => 'Staf Bidang',        'order' => 5, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Putri Nur Wulan',            'npm' => '243040118', 'position' => 'Staf Bidang',        'order' => 6, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Shabina Arvelista Rahman',   'npm' => '243040120', 'position' => 'Staf Bidang',        'order' => 7, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Shania Levia Nurfadillah',   'npm' => '243040117', 'position' => 'Staf Bidang',        'order' => 8, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],

            // ── PSDM ──────────────────────────────────────────────────────────
            ['division_id' => $psdm->id, 'name' => 'Bima Hafit Prakoso',          'npm' => '223040088', 'position' => 'Koordinator Bidang', 'order' => 1, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Rafi Sapiq Mulyadi',          'npm' => '233040023', 'position' => 'Staf Bidang',        'order' => 2, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Alya Khairani',               'npm' => '233040026', 'position' => 'Staf Bidang',        'order' => 3, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'M. Ali Fauzi. JR',            'npm' => '243040079', 'position' => 'Staf Bidang',        'order' => 4, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Ghryshvi Taushiyah Dzickra',  'npm' => '243040086', 'position' => 'Staf Bidang',        'order' => 5, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Arneu Raysa',                 'npm' => '243040089', 'position' => 'Staf Bidang',        'order' => 6, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Firda Armelia',               'npm' => '243040121', 'position' => 'Staf Bidang',        'order' => 7, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Mela Mariska',                'npm' => '243040125', 'position' => 'Staf Bidang',        'order' => 8, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Marsya Dwi Putri Andini',     'npm' => '253040103', 'position' => 'Staf Bidang',        'order' => 9, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],

            // ── PMB ───────────────────────────────────────────────────────────
            ['division_id' => $pmb->id, 'name' => 'Zacky Azmi Asikin',           'npm' => '223040127', 'position' => 'Koordinator Bidang', 'order' => 1, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Muhammad Daffa Musyaffa',     'npm' => '223040048', 'position' => 'Staf Bidang',        'order' => 2, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Muhammad Farid',              'npm' => '243040012', 'position' => 'Staf Bidang',        'order' => 3, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Dimas Muhammad Fadhil',       'npm' => '243040023', 'position' => 'Staf Bidang',        'order' => 4, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Destrian Graha Pratama',      'npm' => '243040069', 'position' => 'Staf Bidang',        'order' => 5, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Try Noer Arreva',             'npm' => '243040073', 'position' => 'Staf Bidang',        'order' => 6, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Salwa Alya',                  'npm' => '243040081', 'position' => 'Staf Bidang',        'order' => 7, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Nazala Qisti',                'npm' => '243040084', 'position' => 'Staf Bidang',        'order' => 8, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Julvah Dwi Sovia',            'npm' => '253040101', 'position' => 'Staf Bidang',        'order' => 9, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
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
