<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Rutas de Artículos
Route::get('/articulos', [ArticlesController::class, 'show'])->name('articulos.show');
Route::get('/articulos/create', [ArticlesController::class, 'create'])->name('articulos.create')->middleware("auth");
Route::post('/articulos', [ArticlesController::class, 'store'])->name('articulos.store');
Route::get('/articulos/{id}', [ArticlesController::class, 'showID']);
Route::delete('/articulos/{id}', [ArticlesController::class, 'destroy'])->name('articulos.destroy')->middleware("auth");
Route::get('/articulos/update/{id}', [ArticlesController::class, 'edit'])->name('articulos.edit')->middleware("auth");
Route::post('/articulos/{id}', [ArticlesController::class, 'update'])->name('articulos.update')->middleware("auth");

// Rutas de Usuarios (solo para administradores)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de Admin (si tienes un AdminController)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});