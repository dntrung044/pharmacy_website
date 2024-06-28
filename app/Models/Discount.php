<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'code',
        'amount',
        'price',
        'condition',
        'status'
    ];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
    ];
}
