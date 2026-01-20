<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; // IMPORTANTE: Agregamos esta línea
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', []);
});

// CORRECCIÓN: Ahora el dashboard usa el DashboardController
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas de la Biblioteca


Route::middleware(['auth', 'verified'])->group(function () {

    // Ruta para ver la lista de Libros
    Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
    Route::get('/libros/create', [LibroController::class, 'create'])->name('libros.create');
    Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');
    Route::get('/libros/{id}/edit', [LibroController::class, 'edit'])->name('libros.edit');
    Route::put('/libros/{id}', [LibroController::class, 'update'])->name('libros.update');


    // Ruta para ver la lista de Autores
    Route::post('/autores', [AutorController::class, 'store'])->name('autores.store');

    // Ruta para ver la lista de Préstamos
    Route::get('/prestamos', function () {
        return Inertia::render('Prestamos/Index');
    })->name('prestamos.index');


    //  Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Préstamos
    Route::resource('prestamos', PrestamoController::class);

    // Estadísticas
    Route::get('prestamos-estadisticas',
        [PrestamoController::class, 'estadisticas']
    )->name('prestamos.estadisticas');

    // Último semestre
    Route::get('prestamos-semestre',
        [PrestamoController::class, 'semestre']
    )->name('prestamos.semestre');

});

require __DIR__.'/auth.php';
