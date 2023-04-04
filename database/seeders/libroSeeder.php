<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class libroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        for($i=0; $i<200; $i++){
            DB::table('libro')->insert([
                'titulo' => $faker->sentence(4),
                'descripcion' => $faker->sentence(400),
                'cantidadPaginas' => $faker->randomNumber(100,2000),
            ]);
        }
    }
}
