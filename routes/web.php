<?php

use App\Services\ApiResponse;
use Illuminate\Support\Facades\Route;

// Rota de Fallback (Caso não exista o Endpoint solicitado)
Route::fallback(function () {
    return ApiResponse::error('Endpoint não encontrado', 404);
});