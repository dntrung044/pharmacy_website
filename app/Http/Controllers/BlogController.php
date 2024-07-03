<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostComment;
use App\Models\PostTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categoryName = $request->input('category');
        $query = Post::with(['category', 'user', 'comments']);
        if ($categoryName) {
            $query->whereHas('category', function ($query) use ($categoryName) {
                $query->where('name', $categoryName);
            });
            // $query = Post::whereHas('category', function ($query) use ($categoryName) {
            //     $query->where('name', $categoryName);
            // })->with(['category', 'user', 'comments'])->get();
        }
        $posts = $query->get();
        $categoryCount = PostCategory::withCount('posts')->get();
        return response()->json([
            'posts' => $posts,
            'categories' => $categoryCount,
        ]);
    }
    public function show($id)
    {
        $post = Post::with(['category', 'author', 'comments'])->findOrFail($id);
        return response()->json($post);
    }

    public function categories()
    {
        $categories = PostCategory::all();
        return response()->json($categories);
    }

    // Method to get all tags
    public function tags()
    {
        $tags = PostTag::all();
        return response()->json($tags);
    }

    // Method to get all comments for a specific post
    public function comments($postId)
    {
        $comments = PostComment::where('post_id', $postId)->with('user')->get();
        return response()->json($comments);
    }

    public function latestPosts()
    {
        $latestPosts = Post::with('category')->latest()->take(3)->get();

        return response()->json($latestPosts);
    }
}
