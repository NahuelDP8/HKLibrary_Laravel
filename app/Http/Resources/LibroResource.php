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
        return [
            'id' => (string)$this->id,
            'type' => 'Libro',
            'attributes' => [
                'titulo' => $this->titulo,
                'precio' => $this->precio,
                'cantidadPaginas' => (string)$this->cantidadPaginas,
                'disponibilidad' => $this->disponible,
                'urlImagen' => $this->urlImagen,
                'descripcion' => $this->descripcion,
            ],
            'relationships' => [
                'autores' => AutorResource::collection($this->autores), 
                'generos' => GeneroResource::collection($this->generos),
            ],
            
        ];
    }
}
