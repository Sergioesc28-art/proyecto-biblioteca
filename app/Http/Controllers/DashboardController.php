<?php
namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller {
    public function index() {
        // PUNTO 2: Libro más y menos prestado
        $libroMas = Libro::withCount('prestamos')->orderBy('prestamos_count', 'desc')->first();
        $libroMenos = Libro::withCount('prestamos')->orderBy('prestamos_count', 'asc')->first();

            // PUNTO 4: Género más visitado
        $generoTop = DB::table('prestamos')
            ->join('libro', 'prestamos.libro_id', '=', 'libro.id_libro')
            ->join('generos', 'libro.genero_id', '=', 'generos.id_genero') // id_genero es la PK de tu tabla
            ->select('generos.nombre', DB::raw('count(*) as total'))
            ->groupBy('generos.nombre')
            ->orderBy('total', 'desc')
            ->first();
        // PUNTO 5: Stock de 4 libros específicos
        $inventario = Libro::select('titulo', 'stock')->limit(4)->get();

        // PUNTO 6: Nacionalidad predominante y Autor con más libros
        $paisTop = DB::table('autor')
            ->join('pais', 'autor.pais_id', '=', 'pais.id_pais')
            ->select('pais.nombre', DB::raw('count(*) as total'))
            ->groupBy('pais.nombre')->orderBy('total', 'desc')->first();
            
        $autorTop = Libro::select('autor_id', DB::raw('count(*) as total'))
            ->with('autor')
            ->groupBy('autor_id')->orderBy('total', 'desc')->first();

        return Inertia::render('Dashboard', [
            'stats' => [
                'libroMas' => $libroMas->titulo ?? 'N/A',
                'libroMenos' => $libroMenos->titulo ?? 'N/A',
                'genero' => $generoTop->nombre ?? 'N/A',
                'pais' => $paisTop->nombre ?? 'N/A',
                'autor' => ($autorTop && $autorTop->autor) ? $autorTop->autor->nombre : 'N/A',
                'listaStock' => $inventario
            ]
        ]);
    }
}