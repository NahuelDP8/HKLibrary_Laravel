<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class generoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generos = [
            'Ficción', 'Drama', 'Misterio', 'Ciencia Ficción', 'Romance', 'Terror',
            'Acción', 'Aventura', 'Infantil', 'Juvenil', 'Humor', 'Fantasía', 'Histórico',
            'Poesía', 'Filosofía', 'Político', 'Educativo', 'Científico', 'Biográfico',
            'Autobiográfico', 'Epistolar', 'Ensayo', 'Periodístico', 'Narrativo',
            'Novela', 'Novela corta', 'Novela gráfica', 'Cuento', 'Cuento corto', 'Fábula',
            'Leyenda', 'Mito', 'Teatro', 'Comedia', 'Tragedia', 'Satírico', 'Sainete',
            'Opera', 'Musical', 'Ballet', 'Zarzuela', 'Vodevil', 'Cabaret', 'Circo',
            'Magia', 'Cine', 'Televisión', 'Radio', 'Publicidad', 'Marketing'
        ];

        for($i=0; $i<count($generos); $i++){
            DB::table('genero')->insert([
                'nombreGenero' => $generos[$i]
            ]);
        }
    }
}
