<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $products = (new Product)->newQuery();

        if (request()->has('search')) {
            $products->where('name', 'Like', '%' . request()->input('search') . '%')->with('category', 'reviews', 'images', 'sizes')->orderBy('id', 'DESC');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $products->orderBy($attribute, $sort_order)->with('category', 'reviews', 'images', 'sizes');
        } else {
            $products->latest()->with('category', 'reviews', 'images', 'sizes')->orderBy('id', 'DESC');
        }

        $products = $products->with('category', 'reviews', 'images', 'sizes')->orderBy('id', 'DESC')->paginate(config('admin.paginate.per_page'))
            ->onEachSide(config('admin.paginate.each_side'))
            ->appends(request()->query());

        return Inertia::render('Admin/Product/Index', [
            'products' => $products,
            'filters' => request()->all('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'status' => 'required|in:active,inactive', // Validate status
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', //
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
                $path = $image->store('public/products');
                $product->images()->create([
                    'product_id' => $product->id,
                    'url' => Storage::url($path),
                    'name' => $image->getClientOriginalName(),
                ]);
            }
        }
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Inertia\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Admin/Product/Edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('admin.products.index')
            ->with('message', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('message', __('Product deleted successfully'));
    }
}
