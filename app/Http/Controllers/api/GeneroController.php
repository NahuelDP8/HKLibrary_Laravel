<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GeneroResource;
use App\Models\Genero;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    /**
     * @OA\Get(
     *      path="/generos",
     *      tags={"Generos"},
     *      description="Devuelve la información de los generos de libros que ofrece la tienda",
     * 
     *      @OA\Response(
     *          response=200,
     *          description="Los generos pudieron recuperarse exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Genero"),
     *              ),
     *          ),
     *      ),
     * )
     */
    public function index()
    {
        $generos = Genero::with('libros')->get();
        return GeneroResource::collection($generos);
    }

    /**
     * @OA\Get(
     *      path="/generos/{id}",
     *      tags={"Generos"},
     *      description="Devuelve la información del genero con la id especificada",
     * 
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *      ),
     *      
     *      @OA\Response(
     *          response=200,
     *          description="Genero encontrado",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/Genero",
     *              ),
     *              
     *          ),
     *       ),
     * 
     *      @OA\Response(
     *          response=404,
     *          description="No existe Genero con la id provista",
     *          @OA\JsonContent(
     *              example={"error":"Genero No Encontrado"}
     *          )
     *       ),
     * 
     *     )
     */
    public function show(string $id)
    {
        try{
            $genero = Genero::with('libros')->findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genero no encontrado'], 404);
        }
        return new GeneroResource($genero);
    }
}
