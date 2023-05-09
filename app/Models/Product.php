<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'supplier',
        'category_id',
        'description_english',
        'description_spanish',
        'price_one',
        'price_two',
        'price_three',
        'price_four',
        'price_five',
        'price_six',
        'price_seven',
        'tax',
    ];
}
