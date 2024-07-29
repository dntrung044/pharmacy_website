<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BlogController extends Controller
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required',
            'status' => 'required|in:active,inactive',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // add img to store   
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/posts');
            $imagePath = Storage::url($path);
        } else {
            return back()->with('error', 'Image upload failed');
        }
        // Create the post
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'user_id' => Auth::user()->id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.blog.index')
            ->with('message', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Inertia\Response
     */
    public function edit(Post $blog)
    {
        $blog->load('category', 'user', 'comments');

        return Inertia::render('Admin/Blog/Edit', [
            'post' => $blog,
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required',
            'status' => 'required|in:active,inactive',
            'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload 
        if ($request->hasFile('imageFile')) {
            // Delete the old image if exists
            if ($post->image && Storage::exists(str_replace('/storage', 'public', $post->image))) {
                Storage::delete(str_replace('/storage', 'public', $post->image));
            }
            // Store the new image
            $path = $request->file('imageFile')->store('public/posts');
            $imagePath = Storage::url($path);
        } else {
            $imagePath = $post->image;
        }

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->status = $request->input('status');
        $post->user_id = Auth::user()->id;
        $post->image = $imagePath;
        $post->save();

        return redirect()->route('admin.blog.index')
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
        if ($post->image) {
            $post->image->store('public/posts');
        }
        // Delete the post
        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('message', __('Post deleted successfully'));
    }
}
