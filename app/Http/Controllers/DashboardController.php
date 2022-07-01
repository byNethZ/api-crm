<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\State;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function salesDashboard(){
        $user = auth()->user();
        $state = [];
        if($user->departament_id === 4 || $user->departament_alt_id === 4){


            $vendor_id = Vendor::where('user_id', $user->id)->first();
            $countByState = DB::table('customers')
            ->where('vendor_id', $vendor_id->id)
            ->join('states', 'states.id', '=', 'customers.state_id')
            ->select('state_id', DB::raw('count(*) as total'), 'states.state_name')
            ->groupBy('state_id')
            ->get();

            $countByCategory = DB::table('customers')
            ->where('vendor_id', $vendor_id->id)
            ->join('customer_types', 'customer_types.id', '=', 'customers.type_id')
            ->select('type_id', DB::raw('count(*) as total'), 'customer_types.type')
            ->groupBy('type_id')
            ->get();

            $message = $vendor_id;
        } else {


            $countByState = DB::table('customers')
            ->join('states', 'states.id', '=', 'customers.state_id')
            ->select('state_id', DB::raw('count(*) as total'), 'states.state_name')
            ->groupBy('state_id')
            ->get();

            $countByCategory = DB::table('customers')
            ->join('customer_types', 'customer_types.id', '=', 'customers.type_id')
            ->select('type_id', DB::raw('count(*) as total'), 'customer_types.type')
            ->groupBy('type_id')
            ->get();

            $message = 'into second conditional';
        }
        $data = [
            'code' => 201,
            'countByState' => $countByState,
            'countByCategory' => $countByCategory,
        ];
        return response()->json($data, $data['code']);
    }
}
