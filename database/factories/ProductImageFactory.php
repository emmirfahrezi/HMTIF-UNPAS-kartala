<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImage;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductImage>
 */
class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->value('id') ?? ProductFactory::new()->create()->id,
            'image_path' => $this->randomUnsplashImage('merchandise,hoodie,tshirt,product,studio'),
            'is_primary' => false,
            'order' => fake()->numberBetween(1, 6),
        ];
    }

    private function randomUnsplashImage(string $keywords): string
    {
        return sprintf(
            'https://source.unsplash.com/1200x1200/?%s&sig=%d',
            urlencode($keywords),
            fake()->numberBetween(1, 10000)
        );
    }
}
