<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    // Nombre de la tabla
    protected $table = 'generos';

    // Llave primaria personalizada
    protected $primaryKey = 'id_genero';

    // No usa created_at ni updated_at
    public $timestamps = false;

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'nombre',
    ];

    public function libros()
    {
        return $this->hasMany(Libro::class, 'genero_id', 'id_genero');
    }
}
