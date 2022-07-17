<?php

namespace App\Http\Controllers;

use App\Mail\FoodBankMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FoodbankController extends Controller
{
    public function sendEmail(Request $request){
        $name = $request['name'];
        $restaurant = $request['restaurant'];
        $phone = $request['phone'];
        $email = $request['email'];
        $photos = $request['photos'];

        $emailDesign= 'netzabliones@gmail.com';

        $message = [
            'name' => $name,
            'restaurant' => $restaurant,
            'phone' => $phone,
            'email' => $email,
            'photos' => $photos
        ];


        $correo = new FoodBankMailable($message);
        Mail::to($emailDesign)->send($correo);

        $data = [
            'name' => $name
        ];

        return response()->json($data, 201);
    }
}
