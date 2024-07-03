<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'content', 'image', 'category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    // public function tags()
    // {
    //     return $this->belongsToMany(PostTag::class, 'post_tags');
    // }
}
