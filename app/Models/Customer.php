<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

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
        'color',
        'place',
        'hobby',
        'movie',
        'music',
        'bio',
        'birthplace',
        'sport',
        'business_number',
        'field_1', //facebook
        'field_2', //asigned by (Digital)
        'field_3', //origin
        'gender',
        'birthday',
        'occupation',
        'marital_status',
        'nationality',
        'language',
        'fears',
        'emotions',
        'needs',
        'identity',
        'dreams',
        'goals',
        'tasks',
        'relations',
        'values',
        'motivators',
        'beliefs',
        'mind',
        'food',
        'personality',
        'mindset',
        'pleasures',
        'finances',
        'wishes',
        'important_dates',
        'challenges',
        'responsability',
        'demotivators',
        'works',
        'notes',
        'token',
        'image'
    ];

    protected $guarded = ['id'];

    public function state(){
        return $this->hasOne(State::class, 'state_id');
    }

    public function interests(){
        return $this->hasOne(ProspectInterest::class, 'customer_id');
    }

    public function industry(){
        return $this->hasOne(CustomerType::class, 'id', 'type_id');
    }

    public function vendor(){
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

}
