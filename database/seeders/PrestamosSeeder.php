<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestamosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prestamos')->insert([
            [
                'libro_id' => 1,
                'user_id' => 1,
                'fecha_prestamo' => '2025-01-01',
                'fecha_devolucion_esperada' => '2025-01-10',
                'fecha_devolucion_real' => '2025-01-09',
            ],
            [
                'libro_id' => 2,
                'user_id' => 2,
                'fecha_prestamo' => '2025-01-05',
                'fecha_devolucion_esperada' => '2025-01-15',
                'fecha_devolucion_real' => null,
            ],
            [
                'libro_id' => 3,
                'user_id' => 3,
                'fecha_prestamo' => '2025-01-08',
                'fecha_devolucion_esperada' => '2025-01-18',
                'fecha_devolucion_real' => '2025-01-17',
            ],
            [
                'libro_id' => 4,
                'user_id' => 1,
                'fecha_prestamo' => '2025-01-12',
                'fecha_devolucion_esperada' => '2025-01-22',
                'fecha_devolucion_real' => null,
            ],
            [
                'libro_id' => 5,
                'user_id' => 2,
                'fecha_prestamo' => '2025-01-15',
                'fecha_devolucion_esperada' => '2025-01-25',
                'fecha_devolucion_real' => null,
            ],
        ]);
    }
}
