<?php

namespace App\Http\Controllers;

use App\Mail\CheckMail;
use App\Models\Customer;
use App\Utils\Utils;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class DashboardController extends Controller
{
    function salesDashboard()
    {
        $user = auth()->user();
        $state = [];
        if ($user->departament_id === 4 && $user->role_id !== 1 || $user->departament_alt_id === 4 && $user->role_id !== 1) {


            //$vendor_id = Vendor::where('user_id', $user->id)->first();
            $countByState = DB::table('customers')
                ->where('vendor_id', $user->id)
                ->where('status', 5)
                ->join('states', 'states.id', '=', 'customers.state_id')
                ->select('state_id', DB::raw('count(*) as total'), 'states.state_name', 'states.lat', 'states.lng')
                ->groupBy('state_id')
                ->get();

            $countByCategory = DB::table('customers')
                ->where('vendor_id', $user->id)
                ->where('status', 5)
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
                ->where('status', 5)
                ->join('states', 'states.id', '=', 'customers.state_id')
                ->select('state_id', DB::raw('count(*) as total'), 'states.state_name', 'states.lat', 'states.lng')
                ->groupBy('state_id')
                ->get();

            $countByCategory = DB::table('customers')
                ->where('status', 5)
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

    public function salesDashboardByVendor($id)
    {
        $countByState = DB::table('customers')
            ->where('vendor_id', $id)
            ->where('status', 5)
            ->join('states', 'states.id', '=', 'customers.state_id')
            ->select('state_id', DB::raw('count(*) as total'), 'states.state_name', 'states.lat', 'states.lng')
            ->groupBy('state_id')
            ->get();

        $countByCategory = DB::table('customers')
            ->where('vendor_id', $id)
            ->where('status', 5)
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

    public function customersByVendor()
    {

        $customersByVendor = DB::table('customers')
            ->where('status', 5)
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

    public function customersCurrentDay()
    {
        $user = auth()->user();

        $start = Carbon::today('America/New_York');
        $end = Carbon::today('America/New_York')->endOfDay();

        // Convert those times to EST
        $start->timezone('EST');
        $end->timezone('EST');

        if ($user->role_id === 1) {


            //$customers = Customer::whereBetween('created_at', [$start, $end])->get();
            $customersTotalByVendor = DB::table('customers')
                ->join('users', 'users.id', '=', 'customers.vendor_id')
                ->groupBy('customers.vendor_id')
                //->select(DB::raw('count(*) as total'), 'users.name')
                ->select(DB::raw('count(*) as total'), 'users.name')
                ->whereBetween('customers.created_at', [$start, $end])
                //->latest()
                //->orderBy('status')
                ->get();

            $customersTotalStatus = DB::table('customers')
                ->join('users', 'users.id', '=', 'customers.vendor_id')
                ->groupBy('customers.vendor_id')
                //->select(DB::raw('count(*) as total'), 'users.name')
                ->groupBy('customers.status')
                ->select(DB::raw('count(*) as total'), 'users.name', DB::raw('customers.status as status'))
                ->whereBetween('customers.created_at', [$start, $end])
                //->latest()
                ->orderBy('customers.vendor_id')
                ->get();

            $customersTotal =  DB::table('customers')
                ->select(DB::raw('count(*) as total'))
                ->whereBetween('customers.created_at', [$start, $end])
                //->latest()
                ->get();

            $data = [
                'code' => 200,
                'data' => [
                    'total' => $customersTotal,
                    'totalbyVendor' => $customersTotalByVendor,
                    'byStatus' => $customersTotalStatus
                ],
            ];
        } else {

            $customersTotal =  Customer::where('vendor_id', $user->id)
                ->whereBetween('customers.created_at', [$start, $end])
                ->count();

            $customersTotalStatus = DB::table('customers')
                ->where('vendor_id', $user->id)
                ->groupBy('customers.status')
                ->select(DB::raw('count(*) as total'), DB::raw('customers.status as status'))
                ->whereBetween('customers.created_at', [$start, $end])
                //->latest()
                ->get();

            $data = [
                'code' => 200,
                'data' => [
                    'total' => $customersTotal,
                    'byStatus' => $customersTotalStatus
                ],
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function terminal()
    {

        $start = Carbon::today('America/New_York');
        $end = Carbon::today('America/New_York')->endOfDay();
        $utils = new Utils();

        // Convert those times to EST
        $start->timezone('EST');
        $end->timezone('EST');

        //$customers = Customer::whereBetween('created_at', [$start, $end])->get();
        $customersTotalByVendor = DB::table('customers')
            ->join('users', 'users.id', '=', 'customers.vendor_id')
            ->groupBy('customers.vendor_id')
            //->select(DB::raw('count(*) as total'), 'users.name')
            ->select(DB::raw('count(*) as total'), 'users.name')
            ->whereBetween('customers.created_at', [$start, $end])
            //->latest()
            //->orderBy('status')
            ->get();

        $customersTotalStatus = DB::table('customers')
            ->join('users', 'users.id', '=', 'customers.vendor_id')
            ->groupBy('customers.vendor_id')
            //->select(DB::raw('count(*) as total'), 'users.name')
            ->groupBy('customers.status')
            ->select(DB::raw('count(*) as total'), 'users.name', DB::raw('customers.status as status'))
            ->whereBetween('customers.created_at', [$start, $end])
            //->latest()
            ->orderBy('customers.vendor_id')
            ->get();

        $customersTotal =  DB::table('customers')
            ->select(DB::raw('count(*) as total'))
            ->whereBetween('customers.created_at', [$start, $end])
            //->latest()
            ->get();

        $data = $utils->mergeArrays($customersTotalByVendor->toArray(), $customersTotalStatus->toArray());
        //$data = array_merge_recursive($customersTotalByVendor->toArray(), $customersTotalStatus->toArray());



        $data = [
            'code' => 200,
            'total' => $customersTotal[0],
            'data' => $data
        ];

        return response()->json($data, $data['code']);
    }

    public function checkemail(){
        $email = 'netzabliones@gmail.com';
        $correo = new CheckMail();
        Mail::to($email)->send($correo);
        return;
    }
}
