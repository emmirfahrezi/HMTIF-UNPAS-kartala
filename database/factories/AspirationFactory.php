<?php

namespace Database\Factories;

use App\Models\Aspiration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AspirationFactory extends Factory
{
    protected $model = Aspiration::class;

    public function definition(): array
    {
        return [
            'subject'       => fake()->sentence(),
            'message'       => fake()->paragraph(),
            'tracking_code' => Str::upper(Str::random(16)),
        ];
    }
}