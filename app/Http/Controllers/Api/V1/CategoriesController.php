<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function listCategories()
    {
        $categories = Category::all(['id','name','description']);
        
        // Usando o name params para usar somente um dos parâmetros da função da ApiResponse
        return ApiResponse::success(data: [
            'categories' => CategoryResource::collection($categories), // Usando o CategoryResource
            'total_categories' => $categories->count()
        ]);
    }

    public function getCategory($id)
    {
        $category = Category::find($id);
        if (!$category){
            return ApiResponse::error("Category with ID {$id} not found", 404);
        }

        return ApiResponse::success([
            'category' => new CategoryResource($category)
        ]);
    }

    public function getProductsByCategory($id)
    {
        $category = Category::find($id);
        if (!$category){
            ApiResponse::error("Category with ID {$id} not found", 404);
        }

        // Transforma o conteúdo em um Array para ser manipulado
        $products = Product::where('category_id', $id)
                    ->get()
                    ->toResourceCollection(ProductResource::class)
                    ->resolve();

        // Aqui manipulamos o array acima e removemos com unset() o CATEGORY de cada produto que ele trouxer
        $products = array_map(function ($product) {
            unset($product['category']);
            return $product;
        }, $products);

        return ApiResponse::success([
            'category' => new CategoryResource($category),
            'products' => $products,
            'totalProducts' => count($products)
        ]);
    }
}