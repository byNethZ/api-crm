<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'url',
        'customer_id',
        'initial_date',
        'end_date',
        'service',
        'payment',
        'invoice',
        'invoice_id',
        'payment_received',
        'payment_method',
        'vendor_id',
        'maintenance'
    ];
}
