<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Added for Auth::user() check
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CuriosidadController;
use App\Http\Controllers\InnovacionController;
use App\Http\Controllers\BiografiaEventoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CuriosidadController as AdminCuriosidadController;
use App\Http\Controllers\Admin\InnovacionController as AdminInnovacionController;
use App\Http\Controllers\Admin\BiografiaEventoController as AdminBiografiaEventoController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('curiosidades', CuriosidadController::class)->only(['index', 'show']);
Route::resource('innovaciones', InnovacionController::class)->only(['index', 'show']);
Route::resource('biografia-eventos', BiografiaEventoController::class)->only(['index', 'show']);

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/dashboard', function () {
    if (Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('curiosidades', AdminCuriosidadController::class);
    Route::resource('innovaciones', AdminInnovacionController::class);
    Route::resource('biografia-eventos', AdminBiografiaEventoController::class);
    Route::patch('comments/{comment}/toggle-approval', [AdminCommentController::class, 'toggleApproval'])->name('comments.toggleApproval');
    Route::resource('comments', AdminCommentController::class)->except(['create', 'store', 'show']);
    Route::resource('users', AdminUserController::class)->only(['index', 'edit', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
