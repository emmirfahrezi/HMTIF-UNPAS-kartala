<?php

namespace App\Services\ProductCategory;

use App\Models\ProductCategory;

class DeleteProductCategoryService
{
    public function execute(ProductCategory $category): void
    {
        $category->delete();
    }
}
