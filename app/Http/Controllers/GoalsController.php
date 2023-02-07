<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $monthsGoal = [
            'jan_goal',
            'feb_goal',
            'mar_goal',
            'apr_goal',
            'may_goal',
            'jun_goal',
            'jul_goal',
            'aug_goal',
            'sep_goal',
            'oct_goal',
            'nov_goal',
            'dec_goal'
        ];

        $monthsResult = [
            'jan_result',
            'feb_result',
            'mar_result',
            'apr_result',
            'may_result',
            'jun_result',
            'jul_result',
            'aug_result',
            'sep_result',
            'oct_result',
            'nov_result',
            'dec_result'
        ];

        $goals = [
            'quantity' => [
                'goals' => [],
                'results' => []
            ],
            'prospects' => [
                'goals' => [],
                'results' => []
            ],
        ];

        if ($id === '99') {

            foreach ($monthsGoal as $monthGoal) {
                $goals['quantity']['goals'] = [...$goals['quantity']['goals'], Goal::where('type', '=', 1)->sum($monthGoal)];
                $goals['prospects']['goals'] = [...$goals['prospects']['goals'], Goal::where('type', '=', 2)->sum($monthGoal)];
            }

            foreach ($monthsResult as $monthResult) {
                $goals['quantity']['results'] = [...$goals['quantity']['results'], Goal::where('type', '=', 1)->sum($monthResult)];
                $goals['prospects']['results'] = [...$goals['prospects']['results'], Goal::where('type', '=', 2)->sum($monthResult)];
            }
        } else {

            foreach ($monthsGoal as $monthGoal) {
                $goals['quantity']['goals'] = [...$goals['quantity']['goals'], Goal::where('type', '=', 1)->where('user_id', $id)->value($monthGoal)];
                $goals['prospects']['goals'] = [...$goals['prospects']['goals'], Goal::where('type', '=', 2)->where('user_id', $id)->value($monthGoal)];
            }

            foreach ($monthsResult as $monthResult) {
                $goals['quantity']['results'] = [...$goals['quantity']['results'], Goal::where('type', '=', 1)->where('user_id', $id)->value($monthResult)];
                $goals['prospects']['results'] = [...$goals['prospects']['results'], Goal::where('type', '=', 2)->where('user_id', $id)->value($monthResult)];
            }
        }

        $data = [
            'code' => 200,
            'goals' => $goals
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
        $validator =  Validator::make($request->all(), [
            'id_vendor' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };

        $validated = $validator->validated();

        $goalsQuantity = Goal::where('user_id', '=', $validated['id_vendor'])
            ->where('type', '=', 1)->first();

        $goalsProspect = Goal::where('user_id', '=', $validated['id_vendor'])
            ->where('type', '=', 2)->first();

        if($goalsQuantity){
            $goalsQuantity->update([
                'jan_goal' => $request['jan_goal_quantity'],
                'jan_result' => $request['jan_result_quantity'],
                'feb_goal' => $request['feb_goal_quantity'],
                'feb_result' => $request['feb_result_quantity'],
                'mar_goal' => $request['mar_goal_quantity'],
                'mar_result' => $request['mar_result_quantity'],
                'apr_goal' => $request['apr_goal_quantity'],
                'apr_result' => $request['apr_result_quantity'],
                'may_goal' => $request['may_goal_quantity'],
                'may_result' => $request['may_result_quantity'],
                'jun_goal' => $request['jun_goal_quantity'],
                'jun_result' => $request['jun_result_quantity'],
                'jul_goal' => $request['jul_goal_quantity'],
                'jul_result' => $request['jul_result_quantity'],
                'aug_goal' => $request['aug_goal_quantity'],
                'aug_result' => $request['aug_result_quantity'],
                'sep_goal' => $request['sep_goal_quantity'],
                'sep_result' => $request['sep_result_quantity'],
                'oct_goal' => $request['oct_goal_quantity'],
                'oct_result' => $request['oct_result_quantity'],
                'nov_goal' => $request['nov_goal_quantity'],
                'nov_result' => $request['nov_result_quantity'],
                'dec_goal' => $request['dec_goal_quantity'],
                'dec_result' => $request['dec_result_quantity'],
            ]);
        } else {
            $goalsQuantity = Goal::create([
                'user_id' => $validated['id_vendor'],
                'type' => 1,
                'jan_goal' => $request['jan_goal_quantity'],
                'jan_result' => $request['jan_result_quantity'],
                'feb_goal' => $request['feb_goal_quantity'],
                'feb_result' => $request['feb_result_quantity'],
                'mar_goal' => $request['mar_goal_quantity'],
                'mar_result' => $request['mar_result_quantity'],
                'apr_goal' => $request['apr_goal_quantity'],
                'apr_result' => $request['apr_result_quantity'],
                'may_goal' => $request['may_goal_quantity'],
                'may_result' => $request['may_result_quantity'],
                'jun_goal' => $request['jun_goal_quantity'],
                'jun_result' => $request['jun_result_quantity'],
                'jul_goal' => $request['jul_goal_quantity'],
                'jul_result' => $request['jul_result_quantity'],
                'aug_goal' => $request['aug_goal_quantity'],
                'aug_result' => $request['aug_result_quantity'],
                'sep_goal' => $request['sep_goal_quantity'],
                'sep_result' => $request['sep_result_quantity'],
                'oct_goal' => $request['oct_goal_quantity'],
                'oct_result' => $request['oct_result_quantity'],
                'nov_goal' => $request['nov_goal_quantity'],
                'nov_result' => $request['nov_result_quantity'],
                'dec_goal' => $request['dec_goal_quantity'],
                'dec_result' => $request['dec_result_quantity'],
            ]);
        }

        if($goalsProspect){
            $goalsProspect->update([
                'jan_goal' => $request['jan_goal_prospect'],
                'jan_result' => $request['jan_result_prospect'],
                'feb_goal' => $request['feb_goal_prospect'],
                'feb_result' => $request['feb_result_prospect'],
                'mar_goal' => $request['mar_goal_prospect'],
                'mar_result' => $request['mar_result_prospect'],
                'apr_goal' => $request['apr_goal_prospect'],
                'apr_result' => $request['apr_result_prospect'],
                'may_goal' => $request['may_goal_prospect'],
                'may_result' => $request['may_result_prospect'],
                'jun_goal' => $request['jun_goal_prospect'],
                'jun_result' => $request['jun_result_prospect'],
                'jul_goal' => $request['jul_goal_prospect'],
                'jul_result' => $request['jul_result_prospect'],
                'aug_goal' => $request['aug_goal_prospect'],
                'aug_result' => $request['aug_result_prospect'],
                'sep_goal' => $request['sep_goal_prospect'],
                'sep_result' => $request['sep_result_prospect'],
                'oct_goal' => $request['oct_goal_prospect'],
                'oct_result' => $request['oct_result_prospect'],
                'nov_goal' => $request['nov_goal_prospect'],
                'nov_result' => $request['nov_result_prospect'],
                'dec_goal' => $request['dec_goal_prospect'],
                'dec_result' => $request['dec_result_prospect'],
            ]);
        } else {
            $goalsProspect = Goal::create([
                'user_id' => $validated['id_vendor'],
                'type' => 2,
                'jan_goal' => $request['jan_goal_prospect'],
                'jan_result' => $request['jan_result_prospect'],
                'feb_goal' => $request['feb_goal_prospect'],
                'feb_result' => $request['feb_result_prospect'],
                'mar_goal' => $request['mar_goal_prospect'],
                'mar_result' => $request['mar_result_prospect'],
                'apr_goal' => $request['apr_goal_prospect'],
                'apr_result' => $request['apr_result_prospect'],
                'may_goal' => $request['may_goal_prospect'],
                'may_result' => $request['may_result_prospect'],
                'jun_goal' => $request['jun_goal_prospect'],
                'jun_result' => $request['jun_result_prospect'],
                'jul_goal' => $request['jul_goal_prospect'],
                'jul_result' => $request['jul_result_prospect'],
                'aug_goal' => $request['aug_goal_prospect'],
                'aug_result' => $request['aug_result_prospect'],
                'sep_goal' => $request['sep_goal_prospect'],
                'sep_result' => $request['sep_result_prospect'],
                'oct_goal' => $request['oct_goal_prospect'],
                'oct_result' => $request['oct_result_prospect'],
                'nov_goal' => $request['nov_goal_prospect'],
                'nov_result' => $request['nov_result_prospect'],
                'dec_goal' => $request['dec_goal_prospect'],
                'dec_result' => $request['dec_result_prospect'],
            ]);
        }

        $data = [
            'code' => 200,
            'result' => [
                'quantityGoals' => $goalsQuantity,
                'prospectGoals' => $goalsProspect,
            ]
        ];

        return response()->json($data, $data['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $goals = Goal::where('user_id', $id)->get();

    //     $data = [
    //         'code' => 200,
    //         'goals' => $goals
    //     ];

    //     return response()->json($data, $data['code']);
    // }

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
        $validator =  Validator::make($request->all(), [
            'month' => 'required',
            'value_quantity' => 'numeric',
            'value_prospect' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };

        $validated = $validator->validated();

        $goalsQuantity = $this->saveGoal($id, 1, $validated['month'], $validated['value_quantity']);
        $goalsProspect = $this->saveGoal($id, 2, $validated['month'], $validated['value_prospect']);

        $data = [
            'code' => 200,
            'goals' => [
                'prospect' => $goalsProspect,
                'quantity' => $goalsQuantity,
            ]
        ];

        return response()->json($data, $data['code']);
    }

    private function saveGoal(int $id, int $type, string $month, $value){
        $goals = Goal::where('user_id', '=', $id)
            ->where('type', '=', $type)->first();
        if($goals){
            $total = 0;
            $lastValue = 0;
            if(is_null($goals[$month])){
                $total = $value;
            } else {
                if(is_string($goals[$month])){
                    $lastValue = intval($goals[$month]);
                } else {
                    $lastValue = $goals[$month];
                }
                $total = $lastValue + $value;
            }

            $goals->update([
                $month => $total,
            ]);
        } else{
            $goals = Goal::create([
                'user_id' => $id,
                'type' => $type,
                $month => $value,
            ]);
        }

        return $goals;
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
