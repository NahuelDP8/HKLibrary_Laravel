<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $table = 'genero';

    public function libros(){
        return $this->belongsToMany(Libro::class,'libro_genero','idGenero','idLibro');
    }
}
