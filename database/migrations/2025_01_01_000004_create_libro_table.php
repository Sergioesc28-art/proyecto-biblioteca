<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libro', function (Blueprint $table) {
            $table->id('id_libro');
            $table->string('titulo', 50);

            $table->foreignId('autor_id')
                  ->constrained('autor', 'id_autor')
                  ->onDelete('cascade');

            $table->foreignId('genero_id')
                  ->constrained('generos', 'id_genero')
                  ->onDelete('cascade');

            $table->integer('stock')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libro');
    }
};
