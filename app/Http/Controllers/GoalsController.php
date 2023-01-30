<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$goals = Goal::all();

        $goalsQuantity = Goal::where('type', '=', 1)->get();
        $goalsProspect = Goal::where('type', '=', 2)->get();

        //$goals = Goal::groupBy('user_id')->select('type', 'jan_goal')->get();

        $data = [
            'code' => 200,
            'goals_quantity' => $goalsQuantity,
            'goals_prospect' => $goalsProspect
        ];

        return response()->json($data, $data['code']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'type' => 'required',
        ]);

        $goals = Goal::create($request->all());

        $data = [
            'code' => 200,
            'result' => $goals
        ];

        return response()->json($data, $data['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goals = Goal::where('user_id', $id)->get();

        $data = [
            'code' => 200,
            'goals' => $goals
        ];

        return response()->json($data, $data['code']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $goals = Goal::find($id);
        $validated = $request->validate([
            'user_id' => 'required',
            'type' => 'required',
        ]);

        $goals->update($request->all());

        $data = [
            'code' => 200,
            'goals' => $goals
        ];

        return response()->json($data, $data['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
