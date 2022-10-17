<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'type',
        'jan_goal',
        'jan_result',
        'feb_goal',
        'feb_result',
        'mar_goal',
        'mar_result',
        'apr_goal',
        'apr_result',
        'may_goal',
        'may_result',
        'jun_goal',
        'jun_result',
        'jul_goal',
        'jul_result',
        'aug_goal',
        'aug_result',
        'sep_goal',
        'sep_result',
        'oct_goal',
        'oct_result',
        'nov_goal',
        'nov_result',
        'dec_goal',
        'dec_result',
    ];
}
