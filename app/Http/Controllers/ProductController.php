<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'reviews', 'images', 'sizes')->orderBy('id', 'DESC')->get();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with('category', 'reviews', 'images', 'sizes')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        // $review_user = $product->reviews->user;
        return response()->json([
            'product' => $product,
            // 'review_user' => $review_user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'images' => 'array',
            'images.*' => 'image|max:3000',
        ]);
        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'price_sale' => $request->price_sale,
            'status' => $request->status,
        ]);
        // Store the images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $path,
                ]);
            }
        }

        return response()->json(['message' => 'Product created successfully']);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

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

        $products = Product::with('category', 'reviews', 'images', 'sizes')->whereIn('category_id', $categoryIdsArray)->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Products not found'], 404);
        }

        return response()->json($products);
    }

    public function deleteImage(Request $request)
    {
        $imageId = $request->input('image_id');

        $image = ProductImage::find($imageId);

        if (!$image) {
            return response()->json(['error' => 'Image not found'], 404);
        }
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully'], 200);
    }
}
