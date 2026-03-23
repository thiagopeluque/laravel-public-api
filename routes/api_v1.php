<?php

use App\Http\Controllers\Api\V1\MainController;
use App\Http\Controllers\Api\V1\ProductsController;
use App\Http\Controllers\Api\V1\CategoriesController;
use App\Services\ApiResponse;
use Illuminate\Support\Facades\Route;

// Rota de Testes da API
Route::get('/status', [MainController::class, 'status']);

// Rotas Produção API
Route::get('/categories', [CategoriesController::class, 'listCategories']);
Route::get('/products', [ProductsController::class, 'listProducts']);

// Rota de Fallback (Caso não exista o Endpoint solicitado)
Route::fallback(function () {
    return ApiResponse::error('Endpoint não encontrado', 404);
});