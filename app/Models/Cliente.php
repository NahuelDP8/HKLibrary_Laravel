<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'cliente';
    protected $hidden = ['created_at','updated_at'];

    public function pedidos():HasMany{
        return $this->hasMany(Pedido::class,'idCliente');
    }

    public function getNombreCompletoAttribute(){
        return "{$this->apellido}, {$this->nombre}";
    }
}
