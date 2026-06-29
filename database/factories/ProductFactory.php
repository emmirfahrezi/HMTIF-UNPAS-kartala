<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->word();

        return [
            'name'  => $name,
            'slug'  => Str::slug($name),
            'price' => fake()->randomFloat(2, 10000, 500000),
        ];
    }
}