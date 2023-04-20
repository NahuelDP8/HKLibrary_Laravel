<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;
class clienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 100; $i++) {
            DB::table('cliente')->insert([
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
                'direccion' => $faker->address,
                'mail' => $faker->unique()->email,
            ]);
        }
    }
}
