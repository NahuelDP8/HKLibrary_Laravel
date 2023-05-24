<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AutorResource;
use App\Models\Autor;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AutorController extends Controller
{
    /**
     * @OA\Get(
     *      path="/autores",
     *      tags={"Autores"},
     *      description="Devuelve la información de todos los autores que tiene registrados la tienda.",
     * 
     *      @OA\Response(
     *          response=200,
     *          description="Los autores pudieron recuperarse exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/AutorIndex"),
     *              ),
     *          ),
     *      ),
     * )
     */
    public function index()
    {
        $autores = Autor::with('libros')->get();
        return AutorResource::collection($autores);
    }

    /**
     * @OA\Get(
     *      path="/autores/{id}",
     *      tags={"Autores"},
     *      description="Devuelve la información del autor con la id especificada. Incluyendo los libros de su autoría que esten disponibles en la tienda.",
     * 
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true
     *      ),
     *      
     *      @OA\Response(
     *          response=200,
     *          description="Autor encontrado",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/AutorShow",
     *              ),
     *              
     *          ),
     *       ),
     * 
     *      @OA\Response(
     *          response=404,
     *          description="No existe Autor con la id provista",
     *          @OA\JsonContent(
     *              example={"error":"Autor No Encontrado"}
     *          )
     *       ),
     * 
     *     )
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
