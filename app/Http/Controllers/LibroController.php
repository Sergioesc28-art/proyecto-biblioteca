<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Genero;
use App\Models\Libro;
use App\Models\Pais;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = Libro::with('autor')->get()->map(function ($libro) {
            return [
                'id_libro' => $libro->id_libro,
                'titulo' => $libro->titulo,
                'autor' => $libro->autor ? $libro->autor->nombre : 'Sin autor',
                'autor_id' => $libro->autor_id,
                'genero_id' => $libro->genero_id,
                'stock' => $libro->stock ?? 0,
            ];
        });

        $autores = Autor::all();
        $paises = Pais::all();
        $generos = Genero::all();

        return Inertia::render('Libros/Index', [
            'libros' => $libros,
            'autores' => $autores,
            'paises' => $paises,
            'generos' => $generos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $libros = Libro::all();
        $autores = Autor::all();
        $paises = Pais::all();
        $generos = Genero::all();

        return Inertia::render('Libros/Index', [
            'libros' => $libros,
            'autores' => $autores,
            'paises' => $paises,
            'generos' => $generos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor_id' => 'required|exists:autor,id_autor',
            'genero_id' => 'required|exists:generos,id_genero',
            'stock' => 'required|integer|min:0',
        ]);

        Libro::create([
            'titulo' => $request->titulo,
            'autor_id' => $request->autor_id,
            'genero_id' => $request->genero_id,
            'stock' => $request->stock,
        ]);

        return redirect()->route('libros.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $libros = Libro::with('autor')->get()->map(function ($libro) {
            return [
                'id_libro' => $libro->id_libro,
                'titulo' => $libro->titulo,
                'autor' => $libro->autor ? $libro->autor->nombre : 'Sin autor',
                'autor_id' => $libro->autor_id,
                'genero_id' => $libro->genero_id,
                'stock' => $libro->stock ?? 0,
            ];
        });

        $autores = Autor::all();
        $paises = Pais::all();
        $generos = Genero::all();

        return Inertia::render('Libros/Index', [
            'libros' => $libros,
            'autores' => $autores,
            'paises' => $paises,
            'generos' => $generos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor_id' => 'required|exists:autor,id_autor',
            'genero_id' => 'required|exists:generos,id_genero',
            'stock' => 'required|integer|min:0',
        ]);

        $libro = Libro::findOrFail($id);
        $libro->update($request->all());

        return redirect()->route('libros.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
