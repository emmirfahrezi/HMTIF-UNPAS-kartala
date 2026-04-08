<?php

namespace App\Services\Store;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllProductsService
{
    public function execute(?string $categorySlug = null): LengthAwarePaginator
    {
        return Product::with(['category', 'primaryImage'])
            ->when(
                $categorySlug,
                fn ($q) => $q->whereHas('category', fn ($q) => $q->where('slug', $categorySlug))
            )
            ->where('is_available', true)
            ->paginate(12);
    }
}
