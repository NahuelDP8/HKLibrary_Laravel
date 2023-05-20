<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LibroResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="LibroShow",
     *         @OA\Property(
     *             property="id",
     *             type="integer",
     *             example=1,
     *         ),
     *         @OA\Property(
     *             property="type",
     *             type="string",
     *             example="Libro",
     *         ),
     *         @OA\Property(
     *             property="titulo",
     *             type="string",
     *             example="Titulo Libro",
     *         ),
     *         @OA\Property(
     *             property="precio",
     *             type="string",
     *             example="940338",
     *         ),
     *         @OA\Property(
     *             property="cantidad_paginas",
     *             type="integer",
     *             example=1177,
     *         ),
     *         @OA\Property(
     *             property="disponibilidad",
     *             type="boolean",
     *             example=false,
     *         ),
     *         @OA\Property(
     *             property="url_imagen",
     *             type="string",
     *             example="https://pzwiki.net/w/images/a/ac/SkillBookAnim_120px.gif",
     *         ),
     *         @OA\Property(
     *             property="descripcion",
     *             type="string",
     *             example="Descripción del libro",
     *         ),
     *         @OA\Property(
     *             property="autores",
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example="154",
     *                 ),
     *                 @OA\Property(
     *                     property="type",
     *                     type="string",
     *                     example="Autor",
     *                 ),
     *                 @OA\Property(
     *                     property="nombre",
     *                     type="string",
     *                     example="Mathilde",
     *                 ),
     *                 @OA\Property(
     *                     property="apellido",
     *                     type="string",
     *                     example="Reinger",
     *                 ),
     *             ), 
     *         ),
     *         @OA\Property(
     *             property="generos",
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example="6",
     *                 ),
     *                 @OA\Property(
     *                     property="type",
     *                     type="string",
     *                     example="Genero",
     *                 ),
     *                 @OA\Property(
     *                     property="nombre_genero",
     *                     type="string",
     *                     example="Terror",
     *                 ),
     *             ),
     *         ),
     * )
     * 
     * @OA\Schema(
     *     schema="LibroIndex",
     *         @OA\Property(
     *             property="id",
     *             type="integer",
     *             example=1,
     *         ),
     *         @OA\Property(
     *             property="type",
     *             type="string",
     *             example="Libro",
     *         ),
     *         @OA\Property(
     *             property="titulo",
     *             type="string",
     *             example="Titulo Libro",
     *         ),
     *         @OA\Property(
     *             property="precio",
     *             type="string",
     *             example="940338",
     *         ),
     *         @OA\Property(
     *             property="cantidad_paginas",
     *             type="integer",
     *             example=1177,
     *         ),
     *         @OA\Property(
     *             property="disponibilidad",
     *             type="boolean",
     *             example=false,
     *         ),
     *         @OA\Property(
     *             property="url_imagen",
     *             type="string",
     *             example="https://pzwiki.net/w/images/a/ac/SkillBookAnim_120px.gif",
     *         ),
     *         @OA\Property(
     *             property="autores",
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example="154",
     *                 ),
     *                 @OA\Property(
     *                     property="type",
     *                     type="string",
     *                     example="Autor",
     *                 ),
     *                 @OA\Property(
     *                     property="nombre",
     *                     type="string",
     *                     example="Mathilde",
     *                 ),
     *                 @OA\Property(
     *                     property="apellido",
     *                     type="string",
     *                     example="Reinger",
     *                 ),
     *             ), 
     *         ),
     *         @OA\Property(
     *             property="generos",
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example="6",
     *                 ),
     *                 @OA\Property(
     *                     property="type",
     *                     type="string",
     *                     example="Genero",
     *                 ),
     *                 @OA\Property(
     *                     property="nombre_genero",
     *                     type="string",
     *                     example="Terror",
     *                 ),
     *             ),
     *         ),
     * )
     */
    public function toArray(Request $request): array
    {
        $autores = $this->whenLoaded('autores');
        $generos = $this->whenLoaded('generos');

        $data = [
            'id' => $this->id,
            'type' => 'Libro',
            'titulo' => $this->titulo,
            'precio' => $this->precio,
            'cantidad_paginas' => $this->cantidadPaginas,
            'disponibilidad' => $this->disponible,
            'url_imagen' => $this->urlImagen,
            'autores' => AutorResource::collection($autores), 
            'generos' => GeneroResource::collection($generos),
        ];

        if ($request->route()->getActionMethod() === 'show') {
            $data['descripcion'] = $this->descripcion;
        }

        return $data;
    }
}
