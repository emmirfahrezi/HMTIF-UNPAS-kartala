<?php

namespace Database\Seeders;

use App\Models\AnnouncementCategory;
use Illuminate\Database\Seeder;

class AnnouncementCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Akademik',            'slug' => 'akademik'],
            ['name' => 'Kemahasiswaan',       'slug' => 'kemahasiswaan'],
            ['name' => 'Lomba & Kompetisi',   'slug' => 'lomba-kompetisi'],
            ['name' => 'Organisasi',           'slug' => 'organisasi'],
            ['name' => 'Beasiswa',             'slug' => 'beasiswa'],
        ];

        foreach ($categories as $data) {
            AnnouncementCategory::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
