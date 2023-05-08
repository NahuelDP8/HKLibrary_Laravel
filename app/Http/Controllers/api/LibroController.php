<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LibroResource;
use App\Models\Libro;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LibroController extends Controller
{
    /**
     * @OA\Get(
     *      path="/libros",
     *      tags={"Libros"},
     *      description="Devuelve la información de todos los libros de la tienda.",
     * 
     *      @OA\Response(
     *          response=200,
     *          description="Los libros pudieron recuperarse exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Libro"),
     *              ),
     *          ),
     *      ),
     * )
     */
    public function index()
    {
        $libros = Libro::with('autores','generos')->get();
        return LibroResource::collection($libros);
    }

    /**
     * @OA\Get(
     *      path="/libros/{id}",
     *      tags={"Libros"},
     *      description="Devuelve la información del libro con la id especificada",
     * 
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *      ),
     *      
     *      @OA\Response(
     *          response=200,
     *          description="Libro encontrado",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/Libro",
     *              ),
     *              
     *          ),
     *       ),
     * 
     *      @OA\Response(
     *          response=404,
     *          description="No existe libro con la id provista",
     *          @OA\JsonContent(
     *              example={"error":"Libro No Encontrado"}
     *          )
     *       ),
     * 
     *     )
     */
    public function show($id)
    {
        try{
            $libro = Libro::with('autores','generos')->findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Libro no encontrado'], 404);
        }
        return new LibroResource($libro);
    }
}
