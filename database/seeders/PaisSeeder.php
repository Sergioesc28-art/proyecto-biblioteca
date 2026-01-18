<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pais')->insert([
            [
                'nombre' => 'México',
            ],
            [
                'nombre' => 'España',
            ],
            [
                'nombre' => 'Argentina',
            ],
            [
                'nombre' => 'Colombia',
            ],
            [
                'nombre' => 'Estados Unidos',
            ],
        ]);
    }
}
