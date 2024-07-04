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
        $post = Post::with(['category', 'user', 'comments'])->findOrFail($id);
        $latestPosts = Post::with('category')->orderBy('created_at', 'desc')->take(3)->get();
        $categoryCount = PostCategory::withCount('posts')->get();

        return response()->json([
            'post' => $post,
            'latestPosts' => $latestPosts,
            'categories' => $categoryCount,
        ]);
    }


    public function categories()
    {
        $categories = PostCategory::all();
        return response()->json($categories);
    }

    public function tags()
    {
        $tags = PostTag::all();
        return response()->json($tags);
    }

    public function getcomments($postId)
    {
        $comments = PostComment::where('post_id', $postId)->with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($comments);
    }
    public function posComment(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|integer',
            'user_id' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $comment = new PostComment();
        $comment->content = $request->input('content');
        $comment->post_id = $request->input('post_id');
        $comment->user_id = $request->input('user_id');
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->save();

        return response()->json($comment, 201);
    }
}
