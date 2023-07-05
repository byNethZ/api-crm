<?php

namespace App\Http\Controllers;

use App\Models\SurveyedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveyedUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'user.name' => 'required|string',
            'user.businessName' => 'required|string',
            'user.phone' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'required|integer'
        ]);

        $data = $validator->validated();

        $surveyedUser = SurveyedUser::create([
            'name' => $data['user']['name'],
            'business_name' => $data['user']['businessName'],
            'phone' => $data['user']['phone'],
            'season' => '0723'
        ]);

        foreach ($data['images'] as $image) {
            $surveyedUser->surveyed_preferences()->create([
                'option_id' => $image
            ]);
        }

        return response()->json([
            'message' => 'Surveyed user created successfully',
            'surveyedUser' => $surveyedUser
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SurveyedUser  $surveyedUser
     * @return \Illuminate\Http\Response
     */
    public function show(SurveyedUser $surveyedUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SurveyedUser  $surveyedUser
     * @return \Illuminate\Http\Response
     */
    public function edit(SurveyedUser $surveyedUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SurveyedUser  $surveyedUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SurveyedUser $surveyedUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SurveyedUser  $surveyedUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(SurveyedUser $surveyedUser)
    {
        //
    }
}
