<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
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
            'name'                 => 'required|string|max:255',
            'slug'                 => 'required|string|max:255|unique:products,slug',
            'product_category_id'  => 'nullable|exists:product_categories,id',
            'price'                => 'required|numeric|min:0',
            'phone_number'         => 'nullable|string|max:255',
            'order_text'           => 'nullable|string',
            'is_available'         => 'boolean',
            'description'          => 'nullable|string',
            'images'               => 'nullable|array',
            'images.*.id'          => 'nullable|string|exists:product_images,id',
            'images.*.image_path'  => 'nullable|string|max:1024',
            'images.*.image_file'  => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'images.*.order'       => 'nullable|integer',
            'images.*.is_primary'  => 'sometimes|boolean',
            'bulk_image_files'     => 'nullable|array',
            'bulk_image_files.*'   => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = $this->createProduct->execute($validated);

        ActivityLog::record('created', $product, "Menambahkan produk: {$product->name}");

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
            'name'                 => 'required|string|max:255',
            'slug'                 => "required|string|max:255|unique:products,slug,{$product->id}",
            'product_category_id'  => 'nullable|exists:product_categories,id',
            'price'                => 'required|numeric|min:0',
            'phone_number'         => 'nullable|string|max:255',
            'order_text'           => 'nullable|string',
            'is_available'         => 'boolean',
            'description'          => 'nullable|string',
            'images'               => 'nullable|array',
            'images.*.id'          => 'nullable|string|exists:product_images,id',
            'images.*.image_path'  => 'nullable|string|max:1024',
            'images.*.image_file'  => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'images.*.order'       => 'nullable|integer',
            'images.*.is_primary'  => 'sometimes|boolean',
            'bulk_image_files'     => 'nullable|array',
            'bulk_image_files.*'   => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $this->updateProduct->execute($product, $validated);

        ActivityLog::record('updated', $product, "Memperbarui produk: {$product->name}");

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        ActivityLog::record('deleted', $product, "Menghapus produk: {$name}");

        $this->deleteProduct->execute($product);

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];

        $products = Product::whereIn('id', $ids)->get();
        foreach ($products as $product) {
            ActivityLog::record('deleted', $product, "Menghapus produk: {$product->name}");
            $this->deleteProduct->execute($product);
        }

        return redirect()->back()->with('success', \count($ids) . ' produk berhasil dihapus.');
    }

    /**
     * Perbarui nomor telepon untuk semua produk sekaligus.
     * Digunakan oleh form "Quick Edit No. Telepon" di halaman daftar produk.
     *
     * Method: PATCH /dashboard/products/bulk-phone
     */
    public function bulkUpdatePhone(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|string|max:255',
        ]);

        $count = Product::query()->update(['phone_number' => $validated['phone_number']]);

        ActivityLog::record(
            'updated',
            new Product(),
            "Memperbarui nomor telepon semua produk ({$count} produk) menjadi: {$validated['phone_number']}",
        );

        return redirect()->back()->with('success', "Nomor telepon {$count} produk berhasil diperbarui.");
    }
}