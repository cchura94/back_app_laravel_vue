<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 
Route::group(['prefix' => 'auth'], function(){
    // /api/auth/login
    Route::post("login", [AuthController::class, "login"]);
    // /api/auth/registro
    Route::post("registro", [AuthController::class, "registro"]);

    Route::group(['middleware' => 'auth:sanctum'], function(){
        // /api/auth/perfil
        Route::get("perfil", [AuthController::class, "perfil"]);// ->middleware("can:ver_perfil");
        // /api/auth/logout
        Route::post("logout", [AuthController::class, "logout"]);
    });
});


Route::group(['middleware' => 'auth:sanctum'], function(){
    // /api
    Route::apiResource("persona", PersonaController::class);
    Route::apiResource("cliente", ClienteController::class);
    Route::apiResource("pedido", PedidoController::class);
    
    
});
Route::apiResource("producto", ProductoController::class);
Route::apiResource("categoria", CategoriaController::class);