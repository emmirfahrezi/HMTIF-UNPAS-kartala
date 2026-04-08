<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ResponseResource;
use App\Services\Store\GetAllProductsService;
use App\Services\Store\GetProductBySlugService;
use App\Services\Store\GetProductCategoriesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct(
        private GetAllProductsService $getAllProducts,
        private GetProductBySlugService $getProductBySlug,
        private GetProductCategoriesService $getProductCategories,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $products = $this->getAllProducts->execute($request->query('category'));

        return ResponseResource::paginated(
            $products,
            ProductResource::collection($products),
            'Products retrieved successfully'
        );
    }

    public function show(string $slug): JsonResponse
    {
        $product = $this->getProductBySlug->execute($slug);

        return ResponseResource::success(
            new ProductResource($product),
            'Product retrieved successfully'
        );
    }

    public function categories(): JsonResponse
    {
        $categories = $this->getProductCategories->execute();

        return ResponseResource::success(
            ProductCategoryResource::collection($categories),
            'Product categories retrieved successfully'
        );
    }
}
