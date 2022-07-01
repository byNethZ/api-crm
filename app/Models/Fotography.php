<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotography extends Model
{
    protected $table = 'fotographies';

    protected $fillable = [
        'restaurante',
        'responsable',
        'accept'
    ];

    use HasFactory;
}
