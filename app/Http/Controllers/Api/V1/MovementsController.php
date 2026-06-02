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
        $movements = Movement::with('product.category')->paginate($perPage);

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
