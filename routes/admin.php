<?php

use App\Http\Controllers\Admin;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('index');

Route::resource('products', Admin\ProductController::class);
Route::resource('product_categories', Admin\ProductCategoryController::class);
Route::resource('blog', Admin\BlogController::class);
Route::resource('blog_categories', Admin\BlogCategoryController::class);
Route::resource('transacions', Admin\ProductController::class);
Route::resource('counpons', Admin\ProductCategoryController::class);
Route::resource('roles', Admin\ProductController::class);
Route::resource('permission', Admin\ProductCategoryController::class);
