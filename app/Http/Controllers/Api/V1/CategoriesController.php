<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
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
}