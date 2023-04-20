<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class pedido_libroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        for ($idPedido = 1; $idPedido <= 100; $idPedido++) {
            $arrayIdLibro = [];
            $cantLibrosDistintos = rand(1, 3);
            for ($j = 0; $j <  $cantLibrosDistintos; $j++) {
                $idLibro = $faker->numberBetween(1, 200);
                while (in_array($idLibro, $arrayIdLibro)) {
                    $idLibro = $faker->numberBetween(1, 200);
                }
                $arrayIdLibro[] = $idLibro;
                $precio =  DB::table('libro')->where('id', $idLibro)->first()->precio;
                DB::table('pedido_libro')->insert([
                    'cantidadUnidades' => $faker->numberBetween(1, 5),
                    'idPedido' => $idPedido,
                    'idLibro' => $idLibro,
                    'precioUnitario' => $precio,
                ]);
            }
        }
    }
}
