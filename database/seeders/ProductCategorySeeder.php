<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Pakaian',    'slug' => 'pakaian'],
            ['name' => 'Aksesoris',  'slug' => 'aksesoris'],
            ['name' => 'Alat Tulis', 'slug' => 'alat-tulis'],
            ['name' => 'Bundling',   'slug' => 'bundling'],
        ];

        foreach ($categories as $data) {
            ProductCategory::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
