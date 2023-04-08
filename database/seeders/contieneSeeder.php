<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class contieneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        for ($idPedido = 0; $idPedido < 100; $idPedido++) {
            $arrayIdLibro = [];
            $cantLibrosDistintos = rand(1, 3);
            for ($j = 0; $j <  $cantLibrosDistintos; $j++) {
                $idLibro = $faker->numberBetween(1, 200);
                while (in_array($idLibro, $arrayIdLibro)) {
                    $idLibro = $faker->numberBetween(1, 200);
                }
                $arrayIdLibro[] = $idLibro;
                DB::table('contiene')->insert([
                    'cantidadUnidades' => $faker->numberBetween(1, 5),
                    'idPedido' => $idPedido,
                    'idLibro' => $idLibro,
                ]);
            }
        }
    }
}
