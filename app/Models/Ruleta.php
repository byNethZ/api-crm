<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruleta extends Model
{
    protected $table = 'ruletas';

    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'email',
        'gift',
        'asesor',
        'delivered'
    ];
    use HasFactory;
}
