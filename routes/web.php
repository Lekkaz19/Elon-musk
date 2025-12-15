<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BiografiaEventoController;
use App\Http\Controllers\InnovacionController;
use App\Http\Controllers\CuriosidadController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Biografía (público)
Route::get('/biografia-eventos', [BiografiaEventoController::class, 'index'])->name('biografia-eventos.index');
Route::get('/biografia-eventos/{id}', [BiografiaEventoController::class, 'show'])->name('biografia-eventos.show');

// Innovaciones (público)
Route::get('/innovaciones', [InnovacionController::class, 'index'])->name('innovaciones.index');
Route::get('/innovaciones/{id}', [InnovacionController::class, 'show'])->name('innovaciones.show');

// Curiosidades (público)
Route::get('/curiosidades', [CuriosidadController::class, 'index'])->name('curiosidades.index');
Route::get('/curiosidades/{id}', [CuriosidadController::class, 'show'])->name('curiosidades.show');

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Usuarios Autenticados)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Dashboard - RUTA CRÍTICA FALTANTE
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Comentarios (usuarios autenticados)
    Route::post('/comentarios', [CommentController::class, 'store'])->name('comentarios.store');
});

/*
|--------------------------------------------------------------------------
| Rutas de Administración
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // Gestión de Biografía
    Route::resource('biografia-eventos', BiografiaEventoController::class)
        ->except(['index', 'show']);
    
    // Gestión de Innovaciones
    Route::resource('innovaciones', InnovacionController::class)
        ->except(['index', 'show']);
    
    // Gestión de Curiosidades
    Route::resource('curiosidades', CuriosidadController::class)
        ->except(['index', 'show']);
    
    // Gestión de Comentarios
    Route::get('/comentarios', [CommentController::class, 'index'])->name('admin.comentarios.index');
    Route::patch('/comentarios/{id}/aprobar', [CommentController::class, 'approve'])->name('admin.comentarios.aprobar');
    Route::delete('/comentarios/{id}', [CommentController::class, 'destroy'])->name('admin.comentarios.destroy');
});
