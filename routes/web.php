<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/Shop', [HomeController::class, 'index'])->name('frontend.shop');
Route::get('/Blog', [HomeController::class, 'index'])->name('frontend.blog');
Route::get('/About', [HomeController::class, 'index'])->name('frontend.about');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
