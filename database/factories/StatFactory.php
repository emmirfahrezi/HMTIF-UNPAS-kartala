<?php

namespace Database\Factories;

use App\Models\Stat;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatFactory extends Factory
{
    protected $model = Stat::class;

    public function definition(): array
    {
        return [
            'label' => fake()->word(),
            'value' => fake()->numberBetween(1, 100) . '+',
        ];
    }
}
