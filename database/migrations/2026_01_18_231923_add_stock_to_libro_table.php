<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('libro', function (Blueprint $table) {
            // Aquí agregamos la columna que falta para el Punto 5
            $table->integer('stock')->default(10)->after('genero_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('libro', function (Blueprint $table) {
            // Esto es por si alguna vez quieres deshacer el cambio
            $table->dropColumn('stock');
        });
    }
};