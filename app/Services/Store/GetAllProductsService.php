<?php

namespace App\Services\Store;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllProductsService
{
    /**
     * Ambil semua produk yang tersedia dengan dukungan filter kategori,
     * pencarian, dan pengurutan.
     *
     * @param  string|null $categorySlug  Filter berdasarkan slug kategori
     * @param  string|null $search        Cari berdasarkan nama atau deskripsi produk
     * @param  string|null $sort          Urutan: 'latest' | 'oldest' | 'az' | 'za' | 'price_asc' | 'price_desc'
     */
    public function execute(
        ?string $categorySlug = null,
        ?string $search       = null,
        ?string $sort         = 'latest',
    ): LengthAwarePaginator {
        return Product::with(['category', 'primaryImage'])
            ->when(
                $categorySlug,
                fn ($q) => $q->whereHas('category', fn ($q) => $q->where('slug', $categorySlug))
            )
            ->when($search, fn ($q) => $q->where(function ($q) use ($search) {
                $q->where('name',        'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            }))
            ->where('is_available', true)
            ->when(true, function ($q) use ($sort) {
                match ($sort) {
                    'oldest'     => $q->orderBy('created_at', 'asc'),
                    'az'         => $q->orderBy('name', 'asc'),
                    'za'         => $q->orderBy('name', 'desc'),
                    'price_asc'  => $q->orderBy('price', 'asc'),
                    'price_desc' => $q->orderBy('price', 'desc'),
                    default      => $q->orderBy('created_at', 'desc'), // 'latest'
                };
            })
            ->paginate(12)
            ->withQueryString();
    }
}
