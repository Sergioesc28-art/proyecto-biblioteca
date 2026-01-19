<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    // Nombre de la tabla
    protected $table = 'prestamos';

    // Llave primaria personalizada
    protected $primaryKey = 'id_prestamo';

    // La tabla no tiene timestamps
    public $timestamps = false;

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'libro_id',
        'user_id',
        'fecha_prestamo',
        'fecha_devolucion_esperada',
        'fecha_devolucion_real',
    ];

    // Un préstamo pertenece a un libro
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id', 'id_libro');
    }

    // Un préstamo pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
