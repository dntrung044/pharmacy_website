<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        return response()->json($categories);
    }

    public function show($id)
    {
        $ProductCategory = ProductCategory::find($id);
        if (!$ProductCategory) {
            return response()->json(['message' => 'ProductCategory not found'], 404);
        }
        return response()->json($ProductCategory);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:ProductCategory_categories,id',
            'price' => 'nullable|integer',
            'price_sale' => 'nullable|integer',
            'active' => 'required|integer',
            'thumb' => 'required|string|max:255',
            'total_number' => 'required|integer',
            'total_rating' => 'required|integer',
        ]);

        $ProductCategory = ProductCategory::create($request->all());
        return response()->json($ProductCategory, 201);
    }

    public function update(Request $request, $id)
    {
        $ProductCategory = ProductCategory::find($id);
        if (!$ProductCategory) {
            return response()->json(['message' => 'ProductCategory not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:ProductCategory_categories,id',
            'price' => 'nullable|integer',
            'price_sale' => 'nullable|integer',
            'active' => 'sometimes|required|integer',
            'thumb' => 'sometimes|required|string|max:255',
            'total_number' => 'sometimes|required|integer',
            'total_rating' => 'sometimes|required|integer',
        ]);

        $ProductCategory->update($request->all());
        return response()->json($ProductCategory);
    }

    public function destroy($id)
    {
        $ProductCategory = ProductCategory::find($id);
        if (!$ProductCategory) {
            return response()->json(['message' => 'ProductCategory not found'], 404);
        }

        $ProductCategory->delete();
        return response()->json(['message' => 'ProductCategory deleted successfully']);
    }
}
