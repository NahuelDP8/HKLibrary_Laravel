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
        $libros = Libro::with('autores','generos')->get();
        return LibroResource::collection($libros);
    }

    /**
     * Resturns the specified book
     */
    public function show($id)
    {
        $libro = Libro::with('autores','generos')->findOrFail($id);
        return new LibroResource($libro);
    }
}
