<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse;

class MainController extends Controller
{
    public function status()
    {
        return ApiResponse::success([], 'API is running OK');
    }
}
