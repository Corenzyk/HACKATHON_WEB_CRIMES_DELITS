<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\RecherchesController;
use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/cartes', [PublicController::class, 'cartes'])->name('cartes');
Route::get('/stats', [ChartController::class, 'index'])->name('statistiques');
Route::get('/recherches', [RecherchesController::class, 'index'])->name('recherches.index');