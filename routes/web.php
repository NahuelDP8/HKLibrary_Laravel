<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function(){
    Route::resource('libros', LibroController::class);
    Route::resource('pedidos', PedidoController::class)->only(['index','show']);

    Route::get('autores',[AutorController::class,'index'])->name('autores.index');
    Route::get('autores/create',[AutorController::class,'create'])->name('autores.create');
    Route::post('autores',[AutorController::class,'store'])->name('autores.store');
    Route::get('autores/{autor}/edit',[AutorController::class,'edit'])->name('autores.edit');
    Route::put('autores/{autor}',[AutorController::class,'update'])->name('autores.update');


    Route::resource('generos',GeneroController::class);
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
