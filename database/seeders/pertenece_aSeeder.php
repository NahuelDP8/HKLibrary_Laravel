<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class pertenece_aSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        for ($idLibro = 1; $idLibro < 200; $idLibro++) {
            $arrayIdGenero = [];
            $cantGeneroDistintos = rand(1, 3);
            for ($j = 0; $j < $cantGeneroDistintos; $j++) {
                $idGenero = $faker->numberBetween(1, 30);
                while (in_array($idGenero, $arrayIdGenero)) {
                    $idGenero = $faker->numberBetween(1, 30);
                }
                $arrayidGenero[] = $idGenero;
                DB::table('pertenece_a')->insert([
                    'idLibro' => $idLibro,
                    'idGenero' => $idGenero,
                ]);
            }
        }
    }
}
