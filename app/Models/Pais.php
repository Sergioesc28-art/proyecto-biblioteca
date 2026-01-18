<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    // Nombre exacto de la tabla
    protected $table = 'pais';

    // Llave primaria personalizada
    protected $primaryKey = 'id_pais';

    // No usa created_at ni updated_at
    public $timestamps = false;

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'nombre',
    ];
}
