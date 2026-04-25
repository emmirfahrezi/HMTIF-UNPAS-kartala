<?php

namespace App\Services\ProductCategory;

use App\Models\ProductCategory;

class CreateProductCategoryService
{
    public function execute(array $validated): ProductCategory
    {
        return ProductCategory::create($validated);
    }
}
