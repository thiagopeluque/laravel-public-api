<?php

use App\Http\Controllers\Api\V1\MainController;
use App\Http\Controllers\Api\V1\ProductsController;
use App\Http\Controllers\Api\V1\CategoriesController;
use App\Http\Controllers\Api\V1\MovementsController;
use App\Services\ApiResponse;
use Illuminate\Support\Facades\Route;

// Rota de Testes da API
Route::get('/status', [MainController::class, 'status']);

// Rotas Produção API
Route::get('/categories', [CategoriesController::class, 'listCategories']);
Route::get('/categories/{id}', [CategoriesController::class, 'getCategory']);

Route::get('/products', [ProductsController::class, 'listProducts']);
Route::get('/products/{id}', [ProductsController::class, 'getProduct']);

Route::get('/movements', [MovementsController::class, 'listMovements']);

// Rota de Fallback (Caso não exista o Endpoint solicitado)
Route::fallback(function () {
    return ApiResponse::error('Endpoint não encontrado', 404);
});