<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';

    public function pedidos():HasMany{
        return $this->hasMany(Pedido::class,'idCliente');
    }

    public function getNombreCompletoAttribute(){
        return "{$this->apellido}, {$this->nombre}";
    }
}
