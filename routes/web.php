<?php

use App\Http\Controllers\ArticlesController;

Route::get('/articulos', [ArticlesController::class, 'show'])->name('articulos.show');
Route::get('/articulos/create', [ArticlesController::class, 'create'])->name('articulos.create');
Route::post('/articulos', [ArticlesController::class, 'store'])->name('articulos.store');
Route::get('/articulos/{id}', [ArticlesController::class, 'showID']);
Route::delete('articulos/{id}', [ArticlesController::class, 'destroy'])->name('articulos.destroy');