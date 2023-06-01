<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedido';

    public function cliente():BelongsTo{
        return $this->belongsTo(Cliente::class,'idCliente');
    }

    public function libros():BelongsToMany{
        $libros = $this->belongsToMany(Libro::class,'pedido_libro','idPedido','idLibro')
                       ->withPivot('cantidadUnidades','precioUnitario');
        return $libros;
    }

    public function getPrecioTotalAttribute(){
        $precioTotal = 0;

        foreach($this->libros as $libro){
            $precioUni = $libro->pivot->precioUnitario;
            $cantUni = $libro->pivot->cantidadUnidades;
            $precioTotal += $precioUni * $cantUni;
        }

        return $precioTotal;
    }
}
