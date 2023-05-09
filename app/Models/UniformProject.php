<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniformProject extends Model
{
    use HasFactory;

    protected $table = 'uniforms_projects';

    public $timestamps = false;

    protected $fillable = [
        'proyect_id',
        'type',
        'color',
        'size_xs',
        'size_s',
        'size_m',
        'size_l',
        'size_xl',
        'size_xxl',
    ];

    public function proyect(){
        return $this->belongsTo(Project::class);
    }
}
