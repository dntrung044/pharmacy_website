<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\ProductImage;
use App\Models\ProductSize;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'name', 'description', 'category_id', 'price', 'price_sale',
        'status', 'total_number', 'total_rating',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
}
