<?php

namespace Database\Factories;

use App\Models\Stat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Stat>
 */
class StatFactory extends Factory
{
    protected $model = Stat::class;

    public function definition(): array
    {
        return [
            'label' => fake()->randomElement([
                'Pengurus Aktif',
                'Agenda Proker',
                'Departemen',
                'Anggota Himpunan',
            ]),
            'value' => fake()->randomElement(['31+', '12+', '6', '300+']),
            'icon' => fake()->randomElement(['users', 'calendar', 'puzzle', 'academic']),
            'order' => fake()->numberBetween(1, 10),
        ];
    }
}
