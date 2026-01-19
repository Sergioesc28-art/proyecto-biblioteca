<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PaisSeeder::class,
            AutorSeeder::class,
            GenerosSeeder::class,
            UserSeeder::class,
            LibroSeeder::class,
            PrestamosSeeder::class,
        ]);
    }
}
