<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\Request;

class GetProductsDashboardService
{
    public function execute(Request $request)
    {
        return Product::with('category')
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('product_category_id', $request->category))
            ->latest('created_at')
            ->paginate(10);
    }
}
