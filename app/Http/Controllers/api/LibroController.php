<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LibroResource;
use App\Models\Libro;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

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
     *                  @OA\Items(ref="#/components/schemas/LibroIndex"),
     *              ),
     *          ),
     *      ),
     * )
     */
    public function index()
    {
        $libros = Libro::with('autores','generos')->where('disponible',true)->get();
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
     *          required=true
     *      ),
     *      
     *      @OA\Response(
     *          response=200,
     *          description="Libro encontrado",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/LibroShow",
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
            $libro = Libro::with('autores','generos')->where('disponible',true)->findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Libro no encontrado'], 404);
        }
        return new LibroResource($libro);
    }


    /**
     * @OA\Get(
     *      path="/libros/{titulo}/searchTitle",
     *      tags={"Libros"},
     *      description="Devuelve los libros que contengan en su titulo el termino especificado",
     * 
     *      @OA\Parameter(
     *          name="titulo",
     *          in="path",
     *          required=true
     *      ),
     *      
     *      @OA\Response(
     *          response=200,
     *          description="Libros encontrados",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/LibroShow",
     *              ),
     *              
     *          ),
     *       ),
     * 
     *      @OA\Response(
     *          response=404,
     *          description="No se encontraron libros con el termino especificado",
     *          @OA\JsonContent(
     *              example={"error":"No se encontraron libros con el termino especificado"}
     *          )
     *       ),
     * 
     *     )
     */
    public function searchByTitle($title){
        $books = Libro::with('autores','generos')->where('titulo', 'ilike', "%$title%")->where('disponible',true)->get();
        
        if(count($books)<=0){
            return response()->json(['error'=>'No se encontraron libros con el termino especificado'], 404);
        }
    
        return LibroResource::collection($books);
    }


    /**
     * @OA\Get(
     *      path="/libros/{genero}/searchGenre",
     *      tags={"Libros"},
     *      description="Devuelve los libros que contengan el termino especificado en el parametro",
     * 
     *      @OA\Parameter(
     *          name="genero",
     *          in="path",
     *          required=true
     *      ),
     *      
     *      @OA\Response(
     *          response=200,
     *          description="Libros encontrados",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/LibroShow",
     *              ),
     *              
     *          ),
     *       ),
     * 
     *      @OA\Response(
     *          response=404,
     *          description="No se encontraron libros con el genero especificado",
     *          @OA\JsonContent(
     *              example={"error":"No se encontraron libros con el genero especificado"}
     *          )
     *       ),
     * 
     *     )
     */
    public function searchByGenre($genero){
        $books = Libro::with('autores','generos')->whereHas('generos', function($query) use ($genero){
            $query->where('nombreGenero','ilike', "%$genero%");
        })->where('disponible',true)->get();

        if(count($books)<=0){
            return response()->json(['error'=>'No se encontraron libros con el genero especificado'], 404);
        }

        return LibroResource::collection($books);
    }


    /**
     * @OA\Get(
     *      path="/libros/{nombreAutor}/searchAuthor",
     *      tags={"Libros"},
     *      description="Devuelve los libros escritos por el autor especificado. El parametro puede contener mas de un nombre o apellido siempre y cuando esten separados por espacios.",
     * 
     *      @OA\Parameter(
     *          name="nombreAutor",
     *          in="path",
     *          required=true
     *      ),
     *      
     *      @OA\Response(
     *          response=200,
     *          description="Libros encontrados",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/LibroShow",
     *              ),
     *              
     *          ),
     *       ),
     * 
     *      @OA\Response(
     *          response=404,
     *          description="No se encontraron libros con los autores especificado",
     *          @OA\JsonContent(
     *              example={"error":"No se encontraron libros con los autores especificado"}
     *          )
     *       ),
     * 
     *     )
     */
    public function searchByAuthor($author){
        $authorStrings = Str::of($author)->explode(' ');

        $authorStrings = $authorStrings->filter(function ($value) {
            return $value !== "";
        });

        $books = Libro::with('autores','generos')->whereHas('autores', function($query) use ($authorStrings){
            $query->where(function ($subquery) use ($authorStrings) {
                foreach ($authorStrings as $authorString) {
                    $subquery->orWhere('nombre', 'ilike', "%$authorString%")
                        ->orWhere('apellido', 'ilike', "%$authorString%");
                }
            });
        })->where('disponible',true)->get();

        if(count($books)<=0){
            return response()->json(['error'=>'No se encontraron libros con el autor especificado'], 404);
        }

        return LibroResource::collection($books);

    }
}
