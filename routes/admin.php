<?php

use App\Http\Controllers\Admin;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('index');

Route::resource('products', Admin\ProductController::class);
Route::resource('product_categories', Admin\ProductCategoryController::class);
