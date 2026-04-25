<?php

namespace App\Services\Product;

use App\Models\Product;

class DeleteProductService
{
    public function execute(Product $product): void
    {
        $product->delete();
    }
}
