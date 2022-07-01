<?php

namespace App\Http\Controllers;

use App\Models\Fotography;
use Illuminate\Http\Request;

class FotographyController extends Controller
{
    function index(){
        return Fotography::all();
    }

    function store(Request $request){

        $request->validate([
            'restaurante'=> 'required',
            'responsable'=> 'required',
            'accept'=> 'required'
        ]);

        return Fotography::create($request->all());
    }

    public function destroy($id)
    {
        return Fotography::destroy($id);
    }
}
