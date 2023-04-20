<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class libro_autorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        for ($idLibro = 1; $idLibro < 200; $idLibro++) {
            $arrayIdAutor = [];
            $cantAutoresDistintos = rand(1, 4);
            for ($j = 0; $j < $cantAutoresDistintos; $j++) {
                $idAutor = $faker->numberBetween(1, 200);
                while (in_array($idAutor, $arrayIdAutor)) {
                    $idAutor = $faker->numberBetween(1, 200);
                }
                $arrayidAutor[] = $idAutor;
                DB::table('libro_autor')->insert([
                    'idLibro' => $idLibro,
                    'idAutor' => $idAutor,
                ]);
            }
        }
    }
}
