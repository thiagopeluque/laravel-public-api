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
        $products = Product::with('category')->get();

        // Usando o name params para usar somente um dos parâmetros da função da ApiResponse
        return ApiResponse::success(data: [
            'products' => ProductResource::collection($products), // Usando o ProductResource
            'total_products' => $products->count()
        ]);
    }
}
