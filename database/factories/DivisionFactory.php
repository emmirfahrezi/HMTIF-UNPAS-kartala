<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Division>
 */
class DivisionFactory extends Factory
{
    protected $model = Division::class;

    public function definition(): array
    {
        $divisionNames = [
            'Kajian Strategis dan Advokasi',
            'Komunikasi dan Informasi',
            'Pengembangan Sumber Daya Mahasiswa',
            'Minat dan Bakat',
            'Kewirausahaan Kreatif',
            'Hubungan Eksternal',
        ];

        $name = fake()->unique()->randomElement($divisionNames);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(14),
            'order' => fake()->numberBetween(1, 10),
        ];
    }
}
