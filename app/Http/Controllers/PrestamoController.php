<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Libro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;

class PrestamoController extends Controller
{
    // Listado de préstamos
    public function index()
    {
        return Inertia::render('Prestamos/Index', [
            'prestamos' => Prestamo::with(['libro', 'user'])->get()
        ]);
    }

    // Formulario crear préstamo
    public function create()
    {
        return Inertia::render('Prestamos/Create', [
            'libros' => Libro::all(),
            'usuarios' => User::all()
        ]);
    }

    // Guardar préstamo
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

    // Ver préstamo
    public function show($id)
    {
        return Inertia::render('Prestamos/Show', [
            'prestamo' => Prestamo::with(['libro', 'user'])->findOrFail($id)
        ]);
    }

    // Registrar devolución
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_devolucion_real' => 'nullable|date'
        ]);

        Prestamo::where('id_prestamo', $id)->update([
            'fecha_devolucion_real' => $request->fecha_devolucion_real
        ]);

        return redirect()->route('prestamos.index');
    }

    // Eliminar préstamo
    public function destroy($id)
    {
        Prestamo::where('id_prestamo', $id)->delete();
        return redirect()->route('prestamos.index');
    }

    //  Libros más y menos prestados
    public function estadisticas()
    {
        $masPrestados = Prestamo::select(
                'libro_id',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('libro_id')
            ->orderByDesc('total')
            ->with('libro')
            ->get();

        $menosPrestados = Prestamo::select(
                'libro_id',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('libro_id')
            ->orderBy('total')
            ->with('libro')
            ->get();

        return Inertia::render('Prestamos/Estadisticas', [
            'masPrestados' => $masPrestados,
            'menosPrestados' => $menosPrestados,
        ]);
    }

    //  Último semestre
    public function semestre()
    {
        $inicio = Carbon::now()->subMonths(6);

        $libroMasPrestado = Prestamo::select(
                'libro_id',
                DB::raw('COUNT(*) as total')
            )
            ->where('fecha_prestamo', '>=', $inicio)
            ->groupBy('libro_id')
            ->orderByDesc('total')
            ->with('libro')
            ->first();

        $usuarioMasPrestamos = Prestamo::select(
                'user_id',
                DB::raw('COUNT(*) as total')
            )
            ->where('fecha_prestamo', '>=', $inicio)
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->with('user')
            ->first();

        return Inertia::render('Prestamos/Semestre', [
            'libroMasPrestado' => $libroMasPrestado,
            'usuarioMasPrestamos' => $usuarioMasPrestamos,
        ]);
    }
}
