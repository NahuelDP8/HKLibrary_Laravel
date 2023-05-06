<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutorResource extends JsonResource
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
            'type' => 'Autor',
            'attributes' => [
                'nombre'=> $this->nombre,
                'apellido'=> $this->apellido,
            ],
            'relationships'=>[
                'libros' => LibroResource::collection($libros),
            ],
        ];
    }
}
