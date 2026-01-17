<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', []);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de la Biblioteca
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Ruta para ver la lista de Libros
    Route::get('/libros', function () {
        return Inertia::render('Libros/Index');
    })->name('libros.index');

    // Ruta para ver la lista de Préstamos
    Route::get('/prestamos', function () {
        return Inertia::render('Prestamos/Index');
    })->name('prestamos.index');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
