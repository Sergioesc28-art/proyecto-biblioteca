<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibroSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('libro')->insert([
            [
                'titulo' => 'Pedro Páramo',
                'autor_id' => 1,   // Juan Rulfo
                'genero_id' => 1,  // Ej: Novela
            ],
            [
                'titulo' => 'Don Quijote de la Mancha',
                'autor_id' => 2,   // Miguel de Cervantes
                'genero_id' => 1,  // Novela
            ],
            [
                'titulo' => 'Ficciones',
                'autor_id' => 3,   // Jorge Luis Borges
                'genero_id' => 2,  // Cuento
            ],
            [
                'titulo' => 'Cien años de soledad',
                'autor_id' => 4,   // Gabriel García Márquez
                'genero_id' => 1,  // Novela
            ],
            [
                'titulo' => 'El viejo y el mar',
                'autor_id' => 5,   // Ernest Hemingway
                'genero_id' => 3,  // Drama
            ],
        ]);
    }
}
