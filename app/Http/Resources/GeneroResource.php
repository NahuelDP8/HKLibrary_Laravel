<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $libros = $this->whenLoaded('libros');

        return [
            'id' => (string)$this->id,
            'type' => 'Genero',
            'nombre_genero'=> $this->nombreGenero,
            'libros' => LibroResource::collection($libros),
        ];
    }
}
