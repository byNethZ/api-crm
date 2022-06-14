<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StatesController extends Controller
{
        /* public function index(){}
    public function store(){}
    public function show(){}
    public function update(){}
    public function destroy(){} */

    public function index()
    {
        return State::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);

        return State::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return State::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $states = State::find($id);
        $states->update($request->all());

        return $states;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return State::destroy($id);
    }

    public function statesByCountry($country){
        $country = intval($country);
        $states = State::where('country_id', '=', $country)->get();
        $data = [
            'code' => 201,
            'states' => $states
        ];

        return response()->json($data, $data['code']);
    }
}
