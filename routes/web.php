<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';


Route::get('/articulos', [ArticlesController::class, 'show'])->name('articulos.show');
Route::get('/articulos/create', [ArticlesController::class, 'create'])->name('articulos.create')->middleware("auth");
Route::post('/articulos', [ArticlesController::class, 'store'])->name('articulos.store');
Route::get('/articulos/{id}', [ArticlesController::class, 'showID']);
Route::delete('/articulos/{id}', [ArticlesController::class, 'destroy'])->name('articulos.destroy')->middleware("auth");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

