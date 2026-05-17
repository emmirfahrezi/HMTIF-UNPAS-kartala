<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\Request;

class GetProductsDashboardService
{
    public function execute(Request $request)
    {
        $query = Product::with('category')
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('product_category_id', $request->category));

        match ($request->sort) {
            'oldest'    => $query->oldest('created_at'),
            'az'        => $query->orderBy('name'),
            'za'        => $query->orderByDesc('name'),
            'cheap'     => $query->orderBy('price'),
            'expensive' => $query->orderByDesc('price'),
            default     => $query->latest('created_at'),
        };

        return $query->paginate(10)->withQueryString();
    }
}
