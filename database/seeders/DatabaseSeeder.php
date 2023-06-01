<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            autorSeeder::class,
            clienteSeeder::class,
            generoSeeder::class,
            libroSeeder::class,
            pedidoSeeder::class,
            pedido_libroSeeder::class,
            libro_generoSeeder::class,
            libro_autorSeeder::class,
            usersSeeder::class,
        ]);
    }
}
