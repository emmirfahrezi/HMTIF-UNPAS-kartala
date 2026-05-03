<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\Product\CreateProductService;
use App\Services\Product\DeleteProductService;
use App\Services\Product\GetProductsDashboardService;
use App\Services\Product\UpdateProductService;
use Illuminate\Http\Request;

class DashboardProductController extends Controller
{
    public function __construct(
        private GetProductsDashboardService $getProducts,
        private CreateProductService $createProduct,
        private UpdateProductService $updateProduct,
        private DeleteProductService $deleteProduct,
    ) {}

    public function index(Request $request)
    {
        $products   = $this->getProducts->execute($request);
        $categories = ProductCategory::orderBy('name')->get();

        return view('dashboard.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = ProductCategory::orderBy('name')->get()->pluck('name', 'id');

        return view('dashboard.products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'phone_number' => 'nullable|string|max:255',
            'order_text' => 'nullable|string',
            'is_available' => 'boolean',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*.id' => 'nullable|integer',
            'images.*.image_path' => 'nullable|string|max:1024',
            'images.*.order' => 'nullable|integer',
            'images.*.is_primary' => 'sometimes|boolean',
        ]);

        $this->createProduct->execute($validated);

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::orderBy('name')->get()->pluck('name', 'id');
        $product->load('images');

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:products,slug,{$product->id}",
            'product_category_id' => 'nullable|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'phone_number' => 'nullable|string|max:255',
            'order_text' => 'nullable|string',
            'is_available' => 'boolean',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*.id' => 'nullable|integer',
            'images.*.image_path' => 'nullable|string|max:1024',
            'images.*.order' => 'nullable|integer',
            'images.*.is_primary' => 'sometimes|boolean',
        ]);

        $this->updateProduct->execute($product, $validated);

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->deleteProduct->execute($product);

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil dihapus.');
    }
}
