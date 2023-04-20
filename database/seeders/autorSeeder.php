<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class autorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        for($i=0; $i<200; $i++){
            DB::table('autor')->insert([
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
            ]);
        }
    }
}
