<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "admin" ,
            'email'=> "admin@iaw.com",
            'password'=> bcrypt("admin123"),
        ]);
        DB::table('users')->insert([
            'name' => "admin2" ,
            'email'=> "pixelpioneers888@gmail.com",
            'password'=> bcrypt("admin123"),
        ]);
    }
}
