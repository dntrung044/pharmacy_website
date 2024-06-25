<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:product_categories,id',
            'price' => 'nullable|integer',
            'price_sale' => 'nullable|integer',
            'active' => 'required|integer',
            'thumb' => 'required|string|max:255',
            'total_number' => 'required|integer',
            'total_rating' => 'required|integer',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:product_categories,id',
            'price' => 'nullable|integer',
            'price_sale' => 'nullable|integer',
            'active' => 'sometimes|required|integer',
            'thumb' => 'sometimes|required|string|max:255',
            'total_number' => 'sometimes|required|integer',
            'total_rating' => 'sometimes|required|integer',
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function getProductsByCategory(Request $request)
    {
        $categoryIds = $request->query('categories');
        $categoryIdsArray = explode(',', $categoryIds);

        $products = Product::whereIn('category_id', $categoryIdsArray)->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Products not found'], 404);
        }

        return response()->json($products);
    }
}
