<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('autor')->insert([
            [
                'nombre' => 'Juan Rulfo',
                'pais_id' => 1, // México
            ],
            [
                'nombre' => 'Miguel de Cervantes',
                'pais_id' => 2, // España
            ],
            [
                'nombre' => 'Jorge Luis Borges',
                'pais_id' => 3, // Argentina
            ],
            [
                'nombre' => 'Gabriel García Márquez',
                'pais_id' => 4, // Colombia
            ],
            [
                'nombre' => 'Ernest Hemingway',
                'pais_id' => 5, // Estados Unidos
            ],
        ]);
    }
}
