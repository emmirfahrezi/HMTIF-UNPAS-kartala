<?php

namespace Database\Factories;

use App\Models\AnnouncementCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<AnnouncementCategory>
 */
class AnnouncementCategoryFactory extends Factory
{
    protected $model = AnnouncementCategory::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Akademik',
            'Organisasi',
            'Kemahasiswaan',
            'Lomba dan Kompetisi',
            'Beasiswa',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
