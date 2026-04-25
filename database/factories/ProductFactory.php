<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Database\Factories\ProductCategoryFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->randomElement([
            'Hoodie Kabinet Kartala',
            'T-Shirt Oversize HMTIF',
            'Lanyard Official HMTIF',
            'Totebag Informatika',
            'Jaket Varsity Informatika',
            'Notebook Kartala Edition',
            'Sticker Pack HMTIF',
            'Bucket Hat HMTIF',
        ]) . ' ' . fake()->numberBetween(2024, 2026);

        return [
            'product_category_id' => ProductCategory::query()->inRandomOrder()->value('id')
                ?? ProductCategoryFactory::new()->create()->id,
            'name' => $name,
            'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(10, 9999)),
            'description' => fake('id_ID')->paragraph(2),
            'price' => fake()->randomElement([15000, 35000, 45000, 65000, 95000, 155000, 185000, 225000]),
            'phone_number' => fake()->e164PhoneNumber(),
            'order_text' => fake('id_ID')->sentence(12),
            'is_available' => fake()->boolean(88),
        ];
    }
}
