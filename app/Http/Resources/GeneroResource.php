<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneroResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="Genero",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         example=1,
     *     ),
     *     @OA\Property(
     *         property="type",
     *         type="string",
     *         example="Genero",
     *     ),
     *     @OA\Property(
     *         property="nombre_genero",
     *         type="string",
     *         example="Ciencia Ficcion",
     *     ),
     *     @OA\Property(
     *         property="libros",
     *         type="array",
     *         @OA\Items(
     *              @OA\Property(
     *                  property="id",
     *                  type="integer",
     *                  example=1,
     *              ),
     *         ),
     *         
     *     ),
     * )
     */

    public function toArray(Request $request): array
    {
        $libros = $this->whenLoaded('libros');

        $data = [
            'id' => $this->id,
            'type' => 'Genero',
            'nombre_genero'=> $this->nombreGenero,
            'libros' => GeneroLibroResource::collection($libros),
        ];

        return $data;
    }
}
