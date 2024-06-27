<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function getProductDetails(Request $request)
    {
        // Lấy danh sách productIds từ request
        $productIds = $request->input('productIds', []);

        // Truy vấn cơ sở dữ liệu để lấy danh sách sản phẩm
        $products = Product::whereIn('id', $productIds)->get();

        // Trả về danh sách sản phẩm dưới dạng JSON
        return response()->json(['products' => $products]);
    }
}
