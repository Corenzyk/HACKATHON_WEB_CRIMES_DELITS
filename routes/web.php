<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/cartes', [PublicController::class, 'cartes'])->name('cartes');
Route::get('/stats', [PublicController::class, 'statistiques'])->name('statistiques');
Route::get('/recherches', [PublicController::class, 'recherches'])->name('recherches');