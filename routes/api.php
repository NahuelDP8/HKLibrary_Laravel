<?php

use App\Http\Controllers\api\AutorController;
use App\Http\Controllers\api\LibroController;
use App\Http\Controllers\api\GeneroController;
use App\Http\Controllers\api\PedidoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::get('libros',[LibroController::class,'index']);
    Route::get('libros/{id}',[LibroController::class,'show'])->whereNumber('id');

    Route::get('autores',[AutorController::class,'index']);
    Route::get('autores/{id}',[AutorController::class,'show'])->whereNumber('id');

    Route::get('generos',[GeneroController::class,'index']);
    Route::get('generos/{id}',[GeneroController::class,'show'])->whereNumber('id');
    
    Route::apiResource('pedidos', PedidoController::class)->only(['store']);
});
