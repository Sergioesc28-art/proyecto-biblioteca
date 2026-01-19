<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Libro;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrestamoController extends Controller
{
    // Mostrar lista de préstamos
    public function index()
    {
        return Inertia::render('Prestamos/Index', [
            'prestamos' => Prestamo::with(['libro', 'user'])->get()
        ]);
    }

    // Mostrar formulario de creación
    public function create()
    {
        return Inertia::render('Prestamos/Create', [
            'libros' => Libro::all(),
            'usuarios' => User::all()
        ]);
    }

    // Guardar un préstamo
    public function store(Request $request)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id_libro',
            'user_id' => 'required|exists:users,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion_esperada' => 'required|date|after_or_equal:fecha_prestamo',
        ]);

        Prestamo::create([
            'libro_id' => $request->libro_id,
            'user_id' => $request->user_id,
            'fecha_prestamo' => $request->fecha_prestamo,
            'fecha_devolucion_esperada' => $request->fecha_devolucion_esperada,
            'fecha_devolucion_real' => null,
        ]);

        return redirect()->route('prestamos.index');
    }

    // Mostrar un préstamo específico
    public function show($id)
    {
        return Inertia::render('Prestamos/Show', [
            'prestamo' => Prestamo::with(['libro', 'user'])->findOrFail($id)
        ]);
    }

    // Actualizar préstamo (por ejemplo, devolución)
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_devolucion_real' => 'nullable|date'
        ]);

        $prestamo = Prestamo::findOrFail($id);
        $prestamo->update([
            'fecha_devolucion_real' => $request->fecha_devolucion_real
        ]);

        return redirect()->route('prestamos.index');
    }

    // Eliminar préstamo
    public function destroy($id)
    {
        Prestamo::destroy($id);

        return redirect()->route('prestamos.index');
    }
}
