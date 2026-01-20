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
        // Evitar fallo si la columna ya fue creada en la migración base
        if (Schema::hasColumn('libro', 'stock')) {
            return;
        }

        Schema::table('libro', function (Blueprint $table) {
            $table->integer('stock')->default(10)->after('genero_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('libro', 'stock')) {
            return;
        }

        Schema::table('libro', function (Blueprint $table) {
            $table->dropColumn('stock');
        });
    }
};
