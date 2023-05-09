<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'order_id',
        'product_id',
        'product_category_id',
        'description',
        'subtotal',
    ];

    public function features()
    {
        if ($this->product_category_id === 1) {
            return $this->hasOne(UniformProject::class);
        }
        return $this->hasOne(UniformProject::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
