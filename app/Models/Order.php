<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'customer_id',
        'shipping_address',
        'shipping_state_id',
        'shipping_zipcode',
        'alternative_phone',
        'address_on_product',
        'subtotal',
        'discount',
        'taxes',
        'obvservations',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
