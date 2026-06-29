<?php

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders product gallery thumbnails that update the main image', function () {
    $this->withoutVite();

    $category = ProductCategory::create([
        'name' => 'Pakaian',
        'slug' => 'pakaian',
    ]);

    $product = Product::create([
        'product_category_id' => $category->id,
        'name' => 'Hoodie Kartala',
        'slug' => 'hoodie-kartala',
        'price' => 150000,
        'is_available' => true,
    ]);

    $product->images()->create([
        'image_path' => 'https://example.com/front.png',
        'order' => 0,
        'is_primary' => true,
    ]);

    $product->images()->create([
        'image_path' => 'https://example.com/back.png',
        'order' => 1,
        'is_primary' => false,
    ]);

    $this->get('/store/hoodie-kartala')
        ->assertOk()
        ->assertSee('activeImage', false)
        ->assertSee('x-bind:src="activeImage"', false)
        ->assertSee('x-on:click="selectImage(', false)
        ->assertSee(':aria-pressed="activeImage ===', false);
});
