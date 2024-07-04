<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/orders', [TransactionController::class, 'placeOrder']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'userLogin']);

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


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('invoices')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::get('/search', [CartController::class, 'search']);
    Route::get('/create', [CartController::class, 'create']);
    Route::post('/store', [CartController::class, 'store']);
    Route::get('/show/{id}', [CartController::class, 'show']);
    Route::get('/edit/{id}', [CartController::class, 'edit']);
    Route::post('/update/{id}', [CartController::class, 'update']);
    Route::get('/delete/{id}', [CartController::class, 'destroy']);
    Route::get('/delete_items/{id}', [CartController::class, 'destroy_items']);
});

Route::prefix('customers')->group(function () {
    Route::get('/', [CartController::class, 'index']);
});


Route::prefix('blog')->group(function () {
    Route::get('/posts', [BlogController::class, 'index']);
    Route::get('/posts/{id}', [BlogController::class, 'show']);
    Route::get('/categories', [BlogController::class, 'categories']);
    Route::get('/latest', [BlogController::class, 'latestPosts']);
    Route::get('/tags', [BlogController::class, 'tags']);
    Route::prefix('comments')->group(function () {
        Route::post('/', [BlogController::class, 'posComment']);
        Route::get('/{postId}', [BlogController::class, 'getcomments']);
    });
});
