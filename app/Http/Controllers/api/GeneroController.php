<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GeneroResource;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generos = Genero::with('libros')->get();
        return GeneroResource::collection($generos);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genero = Genero::with('libros')->findOrFail($id);
        return new GeneroResource($genero);
    }
}
