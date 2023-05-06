<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LibroResource;
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     *Returns a listing of the available books
     */
    public function index()
    {
        $libros = Libro::all();
        return LibroResource::collection($libros);
    }

    /**
     * Resturns the specified book
     */
    public function show(Libro $libro)
    {
        return new LibroResource($libro);
    }
}
