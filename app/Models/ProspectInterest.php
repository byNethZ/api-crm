<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectInterest extends Model
{
    use HasFactory;

    protected $table = 'prospect_interests';

    protected $fillable = [
        'id',
        'customer_id',
        'interests'
    ];
}
