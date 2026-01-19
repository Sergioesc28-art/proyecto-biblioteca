<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Autor extends Model
{
    // Nombre de la tabla en tu base de datos
    protected $table = 'autor';

    // Tu llave primaria personalizada
    protected $primaryKey = 'id_autor';

    // Desactivamos timestamps si no los tienes en la tabla
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'pais_id'
    ];

    /**
     * Un autor tiene muchos libros
     */
    public function libros(): HasMany
    {
        return $this->hasMany(Libro::class, 'autor_id', 'id_autor');
    }

    /**
     * Un autor pertenece a un país (para el Reporte de Origen)
     */
    public function pais(): BelongsTo
    {
        return $this->belongsTo(Pais::class, 'pais_id', 'id_pais');
    }
}