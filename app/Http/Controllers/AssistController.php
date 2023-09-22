<?php

namespace App\Http\Controllers;

use App\Models\Assist;
use Illuminate\Http\Request;

class AssistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event)
    {
        $assists = Assist::where('event', $event)->get();
        return response()->json($assists, 200);
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
    public function store(Request $request, $event, $state)
    {
        //increment assist column
        $assist = Assist::firstOrCreate([
            'event' => $event,
            'state' => $state
        ]);
        $assist->assists = $assist->assists + 1;

        //return response code 200
        if ($assist->save()) {
            return response()->json($assist, 200);
        } else {
            return response()->json($assist, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assist  $assist
     * @return \Illuminate\Http\Response
     */
    public function show(Assist $assist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assist  $assist
     * @return \Illuminate\Http\Response
     */
    public function edit(Assist $assist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assist  $assist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assist $assist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assist  $assist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assist $assist)
    {
        //
    }
}
