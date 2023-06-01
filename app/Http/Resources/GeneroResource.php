<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneroResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="GeneroShow",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         example=1,
     *     ),
     *     @OA\Property(
     *         property="nombre_genero",
     *         type="string",
     *         example="Terror",
     *     ),
     *     @OA\Property(
     *         property="libros",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/LibroIndex"),
     *     ),
     * )
     * 
     * @OA\Schema(
     *     schema="GeneroIndex",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         example=1,
     *     ),
     *     @OA\Property(
     *         property="nombre_genero",
     *         type="string",
     *         example="Terror",
     *     ),
     * )
     */

    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'nombre_genero'=> $this->nombreGenero,
        ];

        if ($request->route()->getActionMethod() === 'show') {
            $data['libros'] = GeneroLibroResource::collection($this->libros);
        }

        return $data;
    }
}
