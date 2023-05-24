<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutorLibroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'precio' => $this->precio,
            'cantidad_paginas' => $this->cantidadPaginas,
            'disponibilidad' => $this->disponible,
            'url_imagen' => $this->urlImagen,
            'autores' => LibroAutorResource::collection($this->autores), 
            'generos' => LibroGeneroResource::collection($this->generos),
        ];
    }
}
