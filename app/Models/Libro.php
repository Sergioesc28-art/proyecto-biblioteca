<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Libro extends Model
{
    // 1. Especificar tabla y llave primaria (según tus capturas)
    protected $table = 'libro';
    protected $primaryKey = 'id_libro';
    public $timestamps = false; 

    protected $fillable = ['titulo', 'autor_id', 'genero_id', 'stock'];

    // 2. Relación para el "Libro Estrella" (withCount)
    public function prestamos(): HasMany
    {
        // 'libro_id' es la columna en la tabla prestamos
        // 'id_libro' es la local
        return $this->hasMany(Prestamo::class, 'libro_id', 'id_libro');
    }

    // 3. Relación para el "Autor con más libros" (with)
    public function autor(): BelongsTo
    {
        // 'autor_id' es la FK en tu tabla libro
        // 'id_autor' es la PK en tu tabla autor
        return $this->belongsTo(Autor::class, 'autor_id', 'id_autor');
    }
}