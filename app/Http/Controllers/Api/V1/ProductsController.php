<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function listProducts()
    {
        $products = Product::with('category:id,name,description')
                            ->get(['id','name','description','category_id']);

        $products->transform(function($product){
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'category' => [
                    'name' => $product->category->name,
                    'description' => $product->category->description
                ]
            ];
        });

        // Usando o name params para usar somente um dos parâmetros da função da ApiResponse
        return ApiResponse::success(data: [
            'products' => $products,
            'total_products' => $products->count()
        ]);
    }
}
