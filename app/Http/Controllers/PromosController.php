<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Ruleta;
use Illuminate\Http\Request;

class PromosController extends Controller
{
    public function index()
    {
        //return Promo::all();
        return Ruleta::where('season', '=', 'black_friday_2022')->get();
    }

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
                'asesor' => $fields['asesor'],
                'delivered' => 0,
                'season' => 'black_friday_2022'
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

    //Ruleta

    public function indexRuleta()
    {
        return Ruleta::where('season', '=', 'black_friday_2022')->get();
    }

    public function saveRuleta(Request $request){

        $response = [];

        $fields = $request->validate([
            'name' => 'string',
            'lastname' => 'string',
            'phone' => 'string',
            'email' => 'email|string',
            'gift' => 'string',
            'asesor' => 'string'
        ]);

        $promo = Ruleta::where('email', $fields['email'])->first();

        if(!$promo){
            $promo = Ruleta::create([
                'name' => $fields['name'],
                'lastname' => $fields['lastname'],
                'phone' => $fields['phone'],
                'email' => $fields['email'],
                'gift' => $fields['gift'],
                'asesor' => $fields['asesor'],
                'delivered' => 0,
                'season' => 'black_friday_2022'
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

    public function setDelivered(Request $request, $id){
        $ruleta = Ruleta::find($id);

        $ruleta->update([
            'delivered' => 1
        ]);

        $response = [
            'code' => 200,
            'ruleta' => $ruleta
        ];

        return response($response, $response['code']);

    }
}
