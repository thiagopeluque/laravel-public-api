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
        $movements = Movement::with('product.category')->get();

        return ApiResponse::success([
            'movements' => MovementResource::collection($movements),
            'totalMovements' => $movements->count()
        ]);
    }
}
