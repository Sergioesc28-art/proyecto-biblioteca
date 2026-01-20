<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = 'prestamos';

    protected $primaryKey = 'id_prestamo';

    public $timestamps = false;

    protected $fillable = [
        'libro_id',
        'user_id',
        'fecha_prestamo',
        'fecha_devolucion_esperada',
        'fecha_devolucion_real',
    ];

    // Relación libro
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id', 'id_libro');
    }

    // Relación usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
