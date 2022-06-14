<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'status',
        'business',
        'name',
        'surname',
        'address',
        'zipcode',
        'country_id',
        'state_id',
        'city',
        'town',
        'phone',
        'email',
        'website',
        'vendor_id',
        'level',
        'type_id',
        'token'
    ];

    protected $guarded = ['id'];

    use HasFactory;
}
