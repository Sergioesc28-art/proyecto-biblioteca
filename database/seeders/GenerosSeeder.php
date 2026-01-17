<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('generos')->insert([
            [
                'nombre' => 'Novela',
            ],
            [
                'nombre' => 'Cuento',
            ],
            [
                'nombre' => 'Drama',
            ],
            [
                'nombre' => 'Poesía',
            ],
            [
                'nombre' => 'Ensayo',
            ],
        ]);
    }
}
