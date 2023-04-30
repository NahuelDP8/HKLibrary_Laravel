<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Libro extends Model
{
    use HasFactory;
    protected $table = 'libro';
    
    public function pedidos():BelongsToMany{
        return $this->belongsToMany(Pedido::class,'pedido_libro','idLibro','idPedido')
                    ->withPivot('cantidadUnidades','precioUnitario');
    }
}
