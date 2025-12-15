<?php

use App\Http\Controllers\{
    DashboardController,
    InnovacionController,
    CuriosidadController,
    BiografiaEventoController,
    CommentController,
    ProfileController,
    HomeController // Added HomeController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (Sin autenticación)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Rutas de Usuario (Requieren autenticación)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Ver contenido (usuarios normales también pueden ver)
    Route::get('/innovaciones', [InnovacionController::class, 'index'])->name('innovaciones.index');
    Route::get('/innovaciones/{innovacion}', [InnovacionController::class, 'show'])->name('innovaciones.show');
    
    Route::get('/curiosidades', [CuriosidadController::class, 'index'])->name('curiosidades.index');
    Route::get('/curiosidades/{curiosidad}', [CuriosidadController::class, 'show'])->name('curiosidades.show');
    
    Route::get('/biografia-eventos', [BiografiaEventoController::class, 'index'])->name('biografia-eventos.index');
    Route::get('/biografia-eventos/{biografia_evento}', [BiografiaEventoController::class, 'show'])->name('biografia-eventos.show');
    
    // Comentarios (usuarios normales pueden comentar)
    Route::post('/comentarios', [CommentController::class, 'store'])->name('comentarios.store');
});

/*
|--------------------------------------------------------------------------
| Rutas de Administrador (Requieren autenticación + permisos admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    
    /*
     * INNOVACIONES - CRUD Completo para Admin
     * Estas rutas permiten: crear, editar, actualizar y eliminar innovaciones
     */
    Route::resource('innovaciones', InnovacionController::class)->except(['index', 'show']);
    
    /*
     * CURIOSIDADES - CRUD Completo para Admin
     */
    Route::resource('curiosidades', CuriosidadController::class)->except(['index', 'show']);
    
    /*
     * BIOGRAFÍA EVENTOS - CRUD Completo para Admin
     */
    Route::resource('biografia-eventos', BiografiaEventoController::class)->except(['index', 'show']);
    
    /*
     * GESTIÓN DE COMENTARIOS
     */
    Route::get('/comentarios', [CommentController::class, 'index'])->name('comentarios.index');
    Route::post('/comentarios/{comment}/approve', [CommentController::class, 'approve'])->name('comentarios.approve');
    Route::delete('/comentarios/{comment}', [CommentController::class, 'destroy'])->name('comentarios.destroy');
});

// Rutas de autenticación (generadas por Breeze/Jetstream)
require __DIR__.'/auth.php';
