<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'name', 'description', 'content', 'category_id', 'price', 'price_sale',
        'active', 'image', 'total_number', 'total_rating', 'button_link', 'button_name', 'thumbnail',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
