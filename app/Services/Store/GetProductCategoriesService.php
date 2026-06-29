<?php

namespace App\Services\Store;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Collection;

class GetProductCategoriesService
{
    public function execute(): Collection
    {
        return ProductCategory::withCount('products')->get();
    }
}
