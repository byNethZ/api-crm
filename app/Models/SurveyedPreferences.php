<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyedPreferences extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function surveyed_user()
    {
        return $this->belongsTo(SurveyedUser::class);
    }
}
