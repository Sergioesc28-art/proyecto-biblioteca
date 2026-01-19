<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrestamoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

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
