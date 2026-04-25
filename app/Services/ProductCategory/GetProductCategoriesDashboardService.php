<?php

namespace App\Services\ProductCategory;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class GetProductCategoriesDashboardService
{
    public function execute(Request $request)
    {
        return ProductCategory::withCount('products')
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->orderBy('name')
            ->paginate(10);
    }
}
