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
     *                 @OA\Property(
     *                     property="type",
     *                     type="string",
     *                     example="Libro",
     *                 ),
     *                 @OA\Property(
     *                     property="titulo",
     *                     type="string",
     *                     example="Titulo del Libro",
     *                 ),
     *                 @OA\Property(
     *                     property="precio",
     *                     type="string",
     *                     example="500.50",
     *                 ),
     *                 @OA\Property(
     *                     property="cantidad_paginas",
     *                     type="integer",
     *                     example="1234",
     *                 ),
     *                 @OA\Property(
     *                     property="disponibilidad",
     *                     type="boolean",
     *                     example="true",
     *                 ),
     *                 @OA\Property(
     *                     property="url_imagen",
     *                     type="string",
     *                     example="https://pzwiki.net/w/images/a/ac/SkillBookAnim_120px.gif",
     *                 ),
     *                 @OA\Property(
     *                     property="descripcion",
     *                     type="string",
     *                     example="Descripcion del libro",
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
            'libros' => LibroResource::collection($libros),
        ];
    }
}
