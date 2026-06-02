<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovementResource;
use App\Models\Movement;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class MovementsController extends Controller
{
    public function listMovements()
    {
        $perPage = request()->input('per_page', 10);
        $allowFields = ['id','product_id','quantity','movement_type','created_at','updated_at'];
        $allowDirections = ['asc','desc'];

        $field = request()->input('field', 'id');
        $direction = request()->input('direction','asc');

        if(!in_array($field, $allowFields)){
            return ApiResponse::error("Field not found or not permitted: {$field}");
        }

        if(!in_array($direction, $allowDirections)){
            return ApiResponse::error("Direction not permitted: {$direction}");
        }

        $movements = Movement::with('product.category')
                    ->orderBy($field, $direction)
                    ->paginate($perPage);

        return ApiResponse::success([
            'movements' => MovementResource::collection($movements),
            'pagination' => [
                'current_page' => $movements->currentPage(),
                'last_page' => $movements->lastPage(),
                'per_page' => $movements->perPage(),
                'total' => $movements->total()
            ]
        ]);
    }
}
