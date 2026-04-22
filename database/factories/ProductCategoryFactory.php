<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Pakaian',
            'Aksesoris',
            'Stationery',
            'Bundling',
            'Limited Edition',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
