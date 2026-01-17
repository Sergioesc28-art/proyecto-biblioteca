<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autor', function (Blueprint $table) {
            $table->id('id_autor');
            $table->string('nombre', 50);
            $table->foreignId('pais_id')
                  ->constrained('pais', 'id_pais')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autor');
    }
};
