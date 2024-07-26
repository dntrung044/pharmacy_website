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
Route::resource('blogs', Admin\ProductController::class);
Route::resource('blog_categories', Admin\ProductCategoryController::class);
Route::resource('transacions', Admin\ProductController::class);
Route::resource('counpons', Admin\ProductCategoryController::class);
Route::resource('roles', Admin\ProductController::class);
Route::resource('permission', Admin\ProductCategoryController::class);

Route::post('/upload', function (Request $request) {
    $request->validate([
        'file' => 'required|image|max:10240', // 10MB max
    ]);

    $path = $request->file('file')->store('uploads', 'public');

    return response()->json([
        'url' => Storage::url($path),
        'name' => $request->file('file')->getClientOriginalName(),
    ]);
});
