<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaisController extends Controller
{
    // Mostrar lista de países
    public function index()
    {
        return Inertia::render('Paises/Index', [
            'paises' => Pais::all()
        ]);
    }

    // Guardar un nuevo país
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100'
        ]);

        Pais::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('paises.index');
    }

    // Mostrar un país (opcional)
    public function show($id)
    {
        $pais = Pais::findOrFail($id);

        return Inertia::render('Paises/Show', [
            'pais' => $pais
        ]);
    }

    // Actualizar un país
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100'
        ]);

        $pais = Pais::findOrFail($id);
        $pais->update([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('paises.index');
    }

    // Eliminar un país
    public function destroy($id)
    {
        Pais::destroy($id);

        return redirect()->route('paises.index');
    }
}
