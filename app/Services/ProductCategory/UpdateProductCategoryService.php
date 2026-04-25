<?php

namespace App\Services\ProductCategory;

use App\Models\ProductCategory;

class UpdateProductCategoryService
{
    public function execute(ProductCategory $category, array $validated): ProductCategory
    {
        $category->update($validated);

        return $category;
    }
}
