<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promos';

    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'email',
        'gift',
        'asesor'
    ];

    use HasFactory;
}
