<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneroController extends Controller
{
    // Mostrar lista de géneros
    public function index()
    {
        return Inertia::render('Generos/Index', [
            'generos' => Genero::all()
        ]);
    }

    // Guardar un nuevo género
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100'
        ]);

        Genero::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('generos.index');
    }

    // Mostrar un género (opcional)
    public function show($id)
    {
        $genero = Genero::findOrFail($id);

        return Inertia::render('Generos/Show', [
            'genero' => $genero
        ]);
    }

    // Actualizar un género
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100'
        ]);

        $genero = Genero::findOrFail($id);
        $genero->update([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('generos.index');
    }

    // Eliminar un género
    public function destroy($id)
    {
        Genero::destroy($id);

        return redirect()->route('generos.index');
    }
}
