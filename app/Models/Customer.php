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
        'field_1',
        'field_2',
        'field_3',
        'gender',
        'birthday',
        'gender',
        'occupation',
        'marital_status',
        'nacionality',
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
