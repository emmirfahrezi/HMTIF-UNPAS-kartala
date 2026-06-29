<?php

namespace Database\Factories;

use App\Models\AnnouncementCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnnouncementCategoryFactory extends Factory
{
    protected $model = AnnouncementCategory::class;

    public function definition(): array
    {
        $name = fake()->word();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}