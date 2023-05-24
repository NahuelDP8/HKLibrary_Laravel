<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutorResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="AutorShow",
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
     *             @OA\Items(ref="#/components/schemas/LibroIndex"),
     *         ),
     * )
     * 
     * @OA\Schema(
     *     schema="AutorIndex",
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
     * )
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'nombre'=> $this->nombre,
            'apellido'=> $this->apellido,
        ];

        if ($request->route()->getActionMethod() === 'show') {
            $data['libros'] = AutorLibroResource::collection($this->libros);
        }

        return $data;
    }
}
