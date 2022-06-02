<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromosController extends Controller
{
    public function save(Request $request){

        $response = [];

        $fields = $request->validate([
            'name' => 'string',
            'lastname' => 'string',
            'phone' => 'string',
            'email' => 'email|string',
            'gift' => 'string',
            'asesor' => 'string'
        ]);

        $promo = Promo::where('email', $fields['email'])->first();

        if(!$promo){
            $promo = Promo::create([
                'name' => $fields['name'],
                'lastname' => $fields['lastname'],
                'phone' => $fields['phone'],
                'email' => $fields['email'],
                'gift' => $fields['gift'],
                'asesor' => $fields['asesor']
            ]);

            $response = [
                'code' => 201,
                'promo' => $promo
            ];

            return response($response, $response['code']);
        }
        $response = [
            'code' => 202,
            'promo' => $promo
        ];

        return response($response, $response['code']);
    }
}
