<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BlogCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $posts = (new Post)->newQuery();

        if (request()->has('search')) {
            $posts->where('name', 'Like', '%' . request()->input('search') . '%')->with('category', 'user', 'comments')->orderBy('id', 'DESC');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $posts->orderBy($attribute, $sort_order)->with('category', 'user', 'comments');
        } else {
            $posts->latest()->with('category', 'user', 'comments')->orderBy('id', 'DESC');
        }

        $posts = $posts->with('category', 'user', 'comments')->orderBy('id', 'DESC')->paginate(config('admin.paginate.per_page'))
            ->onEachSide(config('admin.paginate.each_side'))
            ->appends(request()->query());

        return Inertia::render('Admin/Blog/Index', [
            'posts' => $posts,
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
        return Inertia::render('Admin/Blog/Create');
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

        // Create the post
        $post = Post::create([
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
                $path = $image->store('public/posts');
                $post->images()->create([
                    'post_id' => $post->id,
                    'url' => Storage::url($path),
                    'name' => $image->getClientOriginalName(),
                ]);
            }
        }
        return redirect()->route('admin.posts.index')
            ->with('message', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Inertia\Response
     */
    public function edit(Post $post)
    {
        $post->load('category', 'user', 'comments');

        return Inertia::render('Admin/Blog/Edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request, Post $post)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:post_categories,id',
            'price' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'status' => 'required|string|in:active,inactive',
        ]);
        // Update post details
        $post->update($request->only('name', 'description', 'category_id', 'price', 'price_sale', 'status'));

        // Handle new images 
        if ($request->has('images') && is_array($request->file('images')) && count($request->file('images')) > 0) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('public/posts');
                    $post->images()->create([
                        'post_id' => $post->id,
                        'url' => Storage::url($path),
                        'name' => $image->getClientOriginalName(),
                    ]);
                }
            }
        }

        // Handle removed images 
        if ($request->has('removed_images') && is_array($request->removed_images) && count($request->removed_images) > 0) {
            foreach ($request->removed_images as $imageId) {
                $image = $post->images()->find($imageId);
                if ($image) {
                    Storage::delete(str_replace('/storage', 'public', $image->url));
                    $image->delete();
                }
            }
        }

        return redirect()->route('admin.posts.index')
            ->with('message', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        // Delete post images from storage
        foreach ($post->images as $image) {
            Storage::delete('public/posts/' . $image->image_path);
        }
        // Delete the post
        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('message', __('Post deleted successfully'));
    }
}
