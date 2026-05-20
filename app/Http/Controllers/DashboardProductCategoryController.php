<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Services\ProductCategory\CreateProductCategoryService;
use App\Services\ProductCategory\DeleteProductCategoryService;
use App\Services\ProductCategory\GetProductCategoriesDashboardService;
use App\Services\ProductCategory\UpdateProductCategoryService;
use Illuminate\Http\Request;

class DashboardProductCategoryController extends Controller
{
    public function __construct(
        private GetProductCategoriesDashboardService $getProductCategories,
        private CreateProductCategoryService $createProductCategory,
        private UpdateProductCategoryService $updateProductCategory,
        private DeleteProductCategoryService $deleteProductCategory,
    ) {}

    public function index(Request $request)
    {
        $productCategories = $this->getProductCategories->execute($request);

        return view('dashboard.products.categories.index', compact('productCategories'));
    }

    public function create()
    {
        return view('dashboard.products.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug',
        ]);

        $this->createProductCategory->execute($validated);

        return redirect()->route('dashboard.products.categories')->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    public function edit(ProductCategory $category)
    {
        return view('dashboard.products.categories.edit', compact('category'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:product_categories,slug,{$category->id}",
        ]);

        $this->updateProductCategory->execute($category, $validated);

        return redirect()->route('dashboard.products.categories')->with('success', 'Kategori produk berhasil diperbarui.');
    }

    public function destroy(ProductCategory $category)
    {
        $this->deleteProductCategory->execute($category);

        return redirect()->route('dashboard.products.categories')->with('success', 'Kategori produk berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];

        $categories = ProductCategory::whereIn('id', $ids)->get();
        foreach ($categories as $category) {
            $this->deleteProductCategory->execute($category);
        }

        return redirect()->back()->with('success', count($ids) . ' kategori produk berhasil dihapus.');
    }
}
