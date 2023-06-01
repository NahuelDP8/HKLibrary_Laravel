<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Autor extends Model
{
    use HasFactory;
    protected $table = 'autor';

    protected $fillable = [
        'nombre',
        'apellido'
    ];

    public function libros(): BelongsToMany{
        $libros = $this->belongsToMany(Libro::class,'libro_autor','idAutor','idLibro');
        return  $libros;
    }
}
