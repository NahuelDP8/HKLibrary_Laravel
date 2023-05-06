<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LibroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $autores = $this->whenLoaded('autores');
        $generos = $this->whenLoaded('generos');

        return [
            'id' => (string)$this->id,
            'type' => 'Libro',
            'attributes' => [
                'titulo' => $this->titulo,
                'precio' => $this->precio,
                'cantidad_paginas' => (string)$this->cantidadPaginas,
                'disponibilidad' => $this->disponible,
                'url_imagen' => $this->urlImagen,
                'descripcion' => $this->descripcion,
            ],
            'relationships' => [
                'autores' => AutorResource::collection($autores), 
                'generos' => GeneroResource::collection($generos),
            ],
            
        ];
    }
}
