<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function listProducts()
    {
        $perPage = request()->input('per_page', 10);
        $products = Product::with('category')->paginate($perPage);

        // Usando o name params para usar somente um dos parâmetros da função da ApiResponse
        return ApiResponse::success(data: [
            'products' => ProductResource::collection($products), // Usando o ProductResource
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total()
            ]
        ]);
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        if (!$product){
            return ApiResponse::error("Product with ID {$id} not found", 404);
        }

        return ApiResponse::success([
            'product' => new ProductResource($product)
        ]);
    }
}
