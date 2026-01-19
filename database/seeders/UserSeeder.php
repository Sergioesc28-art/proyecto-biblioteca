<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nombre' => 'Admin',
                'apellido_paterno' => 'Sistema',
                'apellido_materno' => 'Principal',
                'email' => 'admin@mail.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Rodrigo',
                'apellido_paterno' => 'Gonzalez',
                'apellido_materno' => 'Montero',
                'email' => 'rodri@mail.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sergio',
                'apellido_paterno' => 'España',
                'apellido_materno' => 'Lucio',
                'email' => 'sergio@mail.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Brandon',
                'apellido_paterno' => 'Jimenez',
                'apellido_materno' => 'Hau',
                'email' => 'brandonhau373@gmail.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
