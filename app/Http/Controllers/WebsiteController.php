<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        $websites = Website::all();
        //$websitesSorted =  $websites->sortBy('name');
        //$websitesSorted->values()->all();

        return response()->json($websites, 200);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        return Website::create($request->all());
    }

    public function update(Request $request, $id){
        $website = Website::find($id);

        $website->update($request->all());

        return $website;
    }

    public function destroy($id){
        return Website::destroy($id);
    }
}
