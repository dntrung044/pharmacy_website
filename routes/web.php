<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/product-list', [HomeController::class, 'shop'])->name('frontend.shop');
Route::get('/product-detail', [HomeController::class, 'shop'])->name('frontend.shop');
Route::get('/blog', [HomeController::class, 'blog'])->name('frontend.blog');
Route::get('/about', [HomeController::class, 'about'])->name('frontend.about');
Route::get('/cart', [HomeController::class, 'cart'])->name('frontend.cart');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
