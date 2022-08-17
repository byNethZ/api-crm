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


            //$vendor_id = Vendor::where('user_id', $user->id)->first();
            $countByState = DB::table('customers')
            ->where('vendor_id', $user->id)
            ->join('states', 'states.id', '=', 'customers.state_id')
            ->select('state_id', DB::raw('count(*) as total'), 'states.state_name', 'states.lat', 'states.lng')
            ->groupBy('state_id')
            ->get();

            $countByCategory = DB::table('customers')
            ->where('vendor_id', $user->id)
            ->join('customer_types', 'customer_types.id', '=', 'customers.type_id')
            ->select('type_id', DB::raw('count(*) as total'), 'customer_types.type', 'customer_types.isLeader')
            ->groupBy('type_id')
            ->get();

            $customersByStatus = DB::table('customers')
            ->where('vendor_id', $user->id)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

            $message = $user;
        } else {


            $countByState = DB::table('customers')
            ->join('states', 'states.id', '=', 'customers.state_id')
            ->select('state_id', DB::raw('count(*) as total'), 'states.state_name', 'states.lat', 'states.lng')
            ->groupBy('state_id')
            ->get();

            $countByCategory = DB::table('customers')
            ->join('customer_types', 'customer_types.id', '=', 'customers.type_id')
            ->select('type_id', DB::raw('count(*) as total'), 'customer_types.type', 'customer_types.isLeader')
            ->groupBy('type_id')
            ->get();

            $customersByStatus = DB::table('customers')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

            $message = 'into second conditional';
        }
        $data = [
            'code' => 201,
            'countByState' => $countByState,
            'countByCategory' => $countByCategory,
            'customersByStatus' => $customersByStatus,
        ];
        return response()->json($data, $data['code']);
    }

    public function salesDashboardByVendor($id){
        $countByState = DB::table('customers')
        ->where('vendor_id', $id)
        ->join('states', 'states.id', '=', 'customers.state_id')
        ->select('state_id', DB::raw('count(*) as total'), 'states.state_name', 'states.lat', 'states.lng')
        ->groupBy('state_id')
        ->get();

        $countByCategory = DB::table('customers')
        ->where('vendor_id', $id)
        ->join('customer_types', 'customer_types.id', '=', 'customers.type_id')
        ->select('type_id', DB::raw('count(*) as total'), 'customer_types.type', 'customer_types.isLeader')
        ->groupBy('type_id')
        ->get();

        $customersByStatus = DB::table('customers')
        ->where('vendor_id', $id)
        ->select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->get();

        $data = [
            'code' => 201,
            'countByState' => $countByState,
            'countByCategory' => $countByCategory,
            'customersByStatus' => $customersByStatus,
        ];
        return response()->json($data, $data['code']);
    }

    public function customersByVendor(){

        $customersByVendor = DB::table('customers')
        ->join('users', 'users.id', '=', 'customers.vendor_id')
        ->select('vendor_id', DB::raw('count(*) as total'), 'users.name')
        ->groupBy('vendor_id')
        ->get();


        $data = [
            'code' => 201,
            'customerByVendor' => $customersByVendor
        ];
        return response()->json($data, $data['code']);
    }
}
