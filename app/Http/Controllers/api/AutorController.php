<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AutorResource;
use App\Models\Autor;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autores = Autor::with('libros')->get();
        return AutorResource::collection($autores);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $autor = Autor::with('libros')->findOrFail($id);
        return new AutorResource($autor);
    }
}
