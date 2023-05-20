<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutorResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="Autor",
     *         @OA\Property(
     *             property="id",
     *             type="integer",
     *             example=1,
     *         ),
     *         @OA\Property(
     *             property="type",
     *             type="string",
     *             example="Autor",
     *         ),
     *         @OA\Property(
     *             property="nombre",
     *             type="string",
     *             example="Nombre Autor",
     *         ),
     *         @OA\Property(
     *             property="apellido",
     *             type="string",
     *             example="Apellido Autor",
     *         ),
     *         @OA\Property(
     *             property="libros",
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example="154",
     *                 ),
     *             ), 
     *         ),
     * )
     */
    public function toArray(Request $request): array
    {
        $libros = $this->whenLoaded('libros');

        return [
            'id' => $this->id,
            'type' => 'Autor',
            'nombre'=> $this->nombre,
            'apellido'=> $this->apellido,
            'libros' => AutorLibroResource::collection($libros),
        ];
    }
}
