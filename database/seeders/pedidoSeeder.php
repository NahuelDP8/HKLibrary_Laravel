<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class pedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        for($i=1; $i<90; $i++){
            for($j=0; $j<rand(0, 3); $j++){
                 DB::table('pedido')->insert([
                'fecha' => $faker->dateTimeBetween('-1 year', 'now'),
                'idCliente' => $i,
            ]);
        }
           
        }
        
    }
}
