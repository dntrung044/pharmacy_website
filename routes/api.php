<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiscountController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products/by-category', [ProductController::class, 'getProductsByCategory']);

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
    // Route::get('/by-category', [ProductController::class, 'getProductsByCategories']);
});

Route::prefix('product_categories')->group(function () {
    Route::get('/', [ProductCategoriesController::class, 'index']);
    Route::get('/{id}', [ProductCategoriesController::class, 'show']);
    Route::post('/', [ProductCategoriesController::class, 'store']);
    Route::put('/{id}', [ProductCategoriesController::class, 'update']);
    Route::delete('/{id}', [ProductCategoriesController::class, 'destroy']);
});
Route::prefix('carts')->group(function () {
    Route::get('/products_in_cart', [CartController::class, 'getProductDetails']);
});
Route::post('/discounts/apply', [DiscountController::class, 'applyDiscount']);
