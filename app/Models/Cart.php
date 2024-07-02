<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'total_item',
        'total_price',
        'transport_fee',
        'discount_id',
        'transaction_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
