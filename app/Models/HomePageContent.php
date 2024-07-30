<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    use HasFactory;

    protected $fillable = ['hero_carousel', 'content'];

    protected $casts = [
        'hero_carousel' => 'array',
    ];
}
