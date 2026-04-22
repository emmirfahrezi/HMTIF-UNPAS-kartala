<?php

namespace App\Services\Store;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class GetRelatedProductsService
{
    public function execute(Product $product, int $limit = 4): Collection
    {
        return Product::with(['category', 'primaryImage'])
            ->where('id', '!=', $product->id)
            ->where('product_category_id', $product->product_category_id)
            ->where('is_available', true)
            ->limit($limit)
            ->get();
    }
}
