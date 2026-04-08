<?php

namespace App\Services\Store;

use App\Models\Product;

class GetProductBySlugService
{
    public function execute(string $slug): Product
    {
        return Product::with(['category', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
