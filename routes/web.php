<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InnovacionController;
use App\Http\Controllers\CuriosidadController;
use App\Http\Controllers\BiografiaEventoController; // Corregido: BiografiaEventoController
use App\Http\Controllers\Admin\AdminController as DashboardController; // Corregido: Usar AdminController como DashboardController
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Models\Curiosidad;
use App\Models\Innovacion; // Asegurarse de que Innovacion esté importado si se usa en fix-images
use App\Models\BiografiaEvento; // Asegurarse de que BiografiaEvento esté importado si se usa en fix-images
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Añadido para Auth::user()

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTAS PÚBLICAS ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('innovaciones', InnovacionController::class)->only(['index', 'show']);
Route::resource('curiosidades', CuriosidadController::class)->only(['index', 'show']);
Route::resource('biografia-eventos', BiografiaEventoController::class)->only(['index', 'show']);

// --- RUTAS PROTEGIDAS ---
Route::middleware('auth')->group(function () {
    
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- PANEL DE CONTROL (Admin) ---
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Resources con nombres explícitos para evitar conflictos
        // Las rutas 'show' se mantienen públicas, por eso se excluyen aquí
        Route::resource('innovaciones', InnovacionController::class)->except(['show'])->names('innovaciones');
        Route::resource('curiosidades', CuriosidadController::class)->except(['show'])->names('curiosidades');
        Route::resource('biografia-eventos', BiografiaEventoController::class)->except(['show'])->names('biografia-eventos');
        
        Route::resource('comments', AdminCommentController::class)->names('comments');
        Route::resource('users', AdminUserController::class)->names('users');
    });
});

// Ruta utilitaria para arreglar imágenes rotas antiguas
Route::get('/fix-images', function () {
    $img = 'https://images.unsplash.com/photo-1517976487492-5750f3195933?auto=format&fit=crop&w=800&q=80';
    // Se asume que estos modelos tienen el campo 'image_url'
    foreach(Curiosidad::whereNull('image_url')->orWhere('image_url', '')->get() as $i) $i->update(['image_url' => $img]);
    foreach(Innovacion::whereNull('image_url')->orWhere('image_url', '')->get() as $i) $i->update(['image_url' => $img]);
    foreach(BiografiaEvento::whereNull('image_url')->orWhere('image_url', '')->get() as $i) $i->update(['image_url' => $img]);
    
    return "Imágenes corregidas.";
});

require __DIR__.'/auth.php';
