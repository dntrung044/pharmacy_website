<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\HomePageContent;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {
        $homePageContent = HomePageContent::first();
        return Inertia::render('FrontEnd/HomePage', [
            'homePageContent' => $homePageContent,
            'categories' => ProductCategory::all(),
            'productBestSellers' => Product::with("category")->paginate(4),
            'discounts' => Discount::all(),
            // 'canLogin' => Route::has('login'),
            // 'canRegister' => Route::has('register'),
        ]);
    }
    public function shop()
    {
        $products = Product::with('category', 'reviews', 'images', 'sizes')->orderBy('id', 'DESC')->get();
        return Inertia::render('FrontEnd/ProductListPage', [
            'products' => $products,
        ]);
    }
}
