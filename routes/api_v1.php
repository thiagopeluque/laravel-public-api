<?php

use App\Http\Controllers\Api\V1\MainController;
use Illuminate\Support\Facades\Route;

// Rota de Testes da API
Route::get('/status', [MainController::class, 'status']);

// Rotas Produção API



// Rota de Fallback (Caso não exista o Endpoint solicitado)
Route::fallback(function () {
    return response()->json([
        'message' => 'Endpoint não encontrado'
    ], 404);
});