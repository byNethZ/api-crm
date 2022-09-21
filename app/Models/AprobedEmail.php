<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobedEmail extends Model
{
    protected $table = 'aprobedemails';

    protected $fillable = [
        'aprobed',
        'approver',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    use HasFactory;
}
