<?php

namespace App\Http\Controllers;

use App\Models\CustomerType;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    public function index()
    {
        return CustomerType::all();
    }

    public function show($id){
        return CustomerType::find($id);
    }
}
