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
            ['division_id' => $bph->id, 'name' => 'Ali Imran Rodja',                 'position' => 'Ketua Umum',             'order' => 1, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Fakih Helmi Maulana',             'position' => 'Sekretaris Jenderal',    'order' => 2, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Aldi Pradana Hakim',              'position' => 'Sekretaris Umum',        'order' => 3, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Maelani Ningrum',                 'position' => 'Wakil Sekretaris Umum',  'order' => 4, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Muhammad Rizqi Saputra',          'position' => 'Bendahara Umum',         'order' => 5, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Dera Triyadi Fatimah',            'position' => 'Wakil Bendahara Umum',   'order' => 6, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Athaillah Sulthan Firasyal Ilmi', 'position' => 'Kepala Bidang I',        'order' => 7, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $bph->id, 'name' => 'Ilham Ramadhana Hartono',         'position' => 'Kepala Bidang II',       'order' => 8, 'is_bph' => true,  'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],

            // ── KASTRAD ───────────────────────────────────────────────────────
            ['division_id' => $kastrad->id, 'name' => 'Meutuah Dicco Linge',              'position' => 'Koordinator Bidang', 'order' => 1,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Zaki Ramadhan Wijaya',             'position' => 'Staf Bidang',        'order' => 2,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Icha Aprilia Putri',               'position' => 'Staf Bidang',        'order' => 3,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Allkhanidr Cavisya Gedalzi',       'position' => 'Staf Bidang',        'order' => 4,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Dion Marshall Avalon Adhiseputro', 'position' => 'Staf Bidang',        'order' => 5,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Fadli Muhammad Rahmatinata',       'position' => 'Staf Bidang',        'order' => 6,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Zildan Majid Aminuddin',           'position' => 'Staf Bidang',        'order' => 7,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Vicka Aulia Shafira Nurwina',      'position' => 'Staf Bidang',        'order' => 8,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Banyu Biankca Ardansyah',          'position' => 'Staf Bidang',        'order' => 9,  'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Adriel Reihansyah Setiawan',       'position' => 'Staf Bidang',        'order' => 10, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Afsal Prima Maula',                'position' => 'Staf Bidang',        'order' => 11, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kastrad->id, 'name' => 'Ikmal Nurazis',                    'position' => 'Staf Bidang',        'order' => 12, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],

            // ── KOMINFO ───────────────────────────────────────────────────────
            ['division_id' => $kominfo->id, 'name' => 'Kresna Satria Dewantoro',    'position' => 'Koordinator Bidang', 'order' => 1, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Alfi Mifta Nurhakim',        'position' => 'Staf Bidang',        'order' => 2, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => 'Backend Developer Tim Pengembang Website HMTIF-UNPAS Kabinet Kartala.',   'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Aufa Ramadhan',              'position' => 'Staf Bidang',        'order' => 3, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => 'Frontend Developer Tim Pengembang Website HMTIF-UNPAS Kabinet Kartala.', 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Emmir Fahrezi',              'position' => 'Staf Bidang',        'order' => 4, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Andyka Khaerulana',          'position' => 'Staf Bidang',        'order' => 5, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Arya Raihan Hanif',          'position' => 'Staf Bidang',        'order' => 6, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Valdric Abirama Pranaja Dandi', 'position' => 'Staf Bidang',    'order' => 7, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Nasywa Nur Afiffah Salma',   'position' => 'Staf Bidang',        'order' => 8, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $kominfo->id, 'name' => 'Salma Az Zahra',             'position' => 'Staf Bidang',        'order' => 9, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],

            // ── KESKRAF ───────────────────────────────────────────────────────
            ['division_id' => $keskraf->id, 'name' => 'Rama Sadea Putra',           'position' => 'Koordinator Bidang', 'order' => 1, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Daniel Satya Ramadhan',      'position' => 'Staf Bidang',        'order' => 2, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'George Frederik Pingak',     'position' => 'Staf Bidang',        'order' => 3, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Mahesa Rahdintyo Muhammad',  'position' => 'Staf Bidang',        'order' => 4, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Muhammad Aditya Prahaz',     'position' => 'Staf Bidang',        'order' => 5, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Putri Nur Wulan',            'position' => 'Staf Bidang',        'order' => 6, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Shabina Arvelista Rahman',   'position' => 'Staf Bidang',        'order' => 7, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $keskraf->id, 'name' => 'Shania Levia Nurfadillah',   'position' => 'Staf Bidang',        'order' => 8, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],

            // ── PSDM ──────────────────────────────────────────────────────────
            ['division_id' => $psdm->id, 'name' => 'Bima Hafit Prakoso',          'position' => 'Koordinator Bidang', 'order' => 1, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Rafi Sapiq Mulyadi',          'position' => 'Staf Bidang',        'order' => 2, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Alya Khairani',               'position' => 'Staf Bidang',        'order' => 3, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'M. Ali Fauzi. JR',            'position' => 'Staf Bidang',        'order' => 4, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Ghryshvi Taushiyah Dzickra',  'position' => 'Staf Bidang',        'order' => 5, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Arneu Raysa',                 'position' => 'Staf Bidang',        'order' => 6, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Firda Armelia',               'position' => 'Staf Bidang',        'order' => 7, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Mela Mariska',                'position' => 'Staf Bidang',        'order' => 8, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $psdm->id, 'name' => 'Marsya Dwi Putri Andini',     'position' => 'Staf Bidang',        'order' => 9, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],

            // ── PMB ───────────────────────────────────────────────────────────
            ['division_id' => $pmb->id, 'name' => 'Zacky Azmi Asikin',           'position' => 'Koordinator Bidang', 'order' => 1, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Muhammad Daffa Musyaffa',     'position' => 'Staf Bidang',        'order' => 2, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Muhammad Farid',              'position' => 'Staf Bidang',        'order' => 3, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Dimas Muhammad Fadhil',       'position' => 'Staf Bidang',        'order' => 4, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Destrian Graha Pratama',      'position' => 'Staf Bidang',        'order' => 5, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Try Noer Arreva',             'position' => 'Staf Bidang',        'order' => 6, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Salwa Alya',                  'position' => 'Staf Bidang',        'order' => 7, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Nazala Qisti',                'position' => 'Staf Bidang',        'order' => 8, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
            ['division_id' => $pmb->id, 'name' => 'Julvah Dwi Sovia',            'position' => 'Staf Bidang',        'order' => 9, 'is_bph' => false, 'is_active' => true, 'photo' => null, 'bio' => null, 'instagram' => null, 'linkedin' => null],
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
