<?php

use App\Http\Controllers\api\AutorController;
use App\Http\Controllers\api\LibroController;
use App\Http\Controllers\api\GeneroController;
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
    Route::apiResource('libros', LibroController::class)->only(['index','show']);
    Route::apiResource('autores', AutorController::class)->only(['index','show']);
    Route::apiResource('generos', GeneroController::class)->only(['index','show']);
});
