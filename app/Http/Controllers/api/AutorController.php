<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AutorResource;
use App\Models\Autor;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        try{
            $autor = Autor::with('libros')->findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Autor no encontrado'], 404);
        }
        return new AutorResource($autor);
    }
}
