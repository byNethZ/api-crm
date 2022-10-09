<?php

namespace App\Http\Controllers;

use App\Mail\CheckMail;
use App\Models\Customer;
use App\Models\User;
use App\Utils\Utils;
use App\WhatsAppChannel\WhatsAppChannel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PanelController extends Controller
{
    public function sendReports($id, $mode = 'day'){

        $user = User::find($id);
        $utils = new Utils();
        $message = new WhatsAppChannel;

        $phone = $user->public_phone ? $user->public_phone : $user->personal_phone;

        if( $mode === 'month' ) {

            $now = Carbon::now();
            $start = $now->startOfMonth()->format('Y-m-d H:i');
            $end = $now->endOfMonth()->format('Y-m-d H:i');
        }

        if( $mode === 'week') {
            $now = Carbon::now();
            $start = $now->startOfWeek()->format('Y-m-d H:i');
            $end = $now->endOfWeek()->format('Y-m-d H:i');
        }

        if( $mode === 'day' ){
            $start = Carbon::today('America/New_York');
            $end = Carbon::today('America/New_York')->endOfDay();

            // Convert those times to EST
            $start->timezone('EST');
            $end->timezone('EST');
        }

        // Convert those times to EST
        //$start->timezone('EST');
        //$end->timezone('EST');

        $customersTotalByVendor = DB::table('customers')
            ->join('users', 'users.id', '=', 'customers.vendor_id')
            ->groupBy('customers.vendor_id')
            ->select(DB::raw('count(*) as total'), 'users.name')
            ->whereBetween('customers.created_at', [$start, $end])
            //->orderBy('status')
            ->get();

        $customersTotalStatus = DB::table('customers')
            ->join('users', 'users.id', '=', 'customers.vendor_id')
            ->groupBy('customers.vendor_id')
            ->groupBy('customers.status')
            ->select(DB::raw('count(*) as total'), 'users.name', DB::raw('customers.status as status'))
            ->whereBetween('customers.created_at', [$start, $end])
            ->orderBy('customers.vendor_id')
            ->get();

        $customersTotal =  DB::table('customers')
            ->select(DB::raw('count(*) as total'))
            ->whereBetween('customers.created_at', [$start, $end])
            ->get();

        $customersTotalDigital =  DB::table('customers')
            ->whereNotNull('field_2')
            ->select(DB::raw('count(*) as total'))
            ->whereBetween('customers.created_at', [$start, $end])
            ->get();

        $customersTotalByMarketing = DB::table('customers')
            ->join('users', 'users.id', '=', 'customers.field_2')
            ->groupBy('customers.field_2')
            //->select(DB::raw('count(*) as total'), 'users.name')
            ->select(DB::raw('count(*) as total'), 'users.name')
            ->whereBetween('customers.created_at', [$start, $end])
            //->latest()
            //->orderBy('status')
            ->get();

        $data = $utils->mergeArrays($customersTotalByVendor->toArray(), $customersTotalStatus->toArray());

        if( $mode === 'day' ) {
            $message->prospectsDaily($customersTotal[0], $data, $customersTotalDigital[0], 'diario', $customersTotalByMarketing->toArray(), $phone);
        }

        if( $mode === 'week' ) {
            $message->prospectsDaily($customersTotal[0], $data, $customersTotalDigital[0], 'semanal', $customersTotalByMarketing->toArray(), $phone);
        }

        if( $mode === 'month' ) {
            $message->prospectsDaily($customersTotal[0], $data, $customersTotalDigital[0], 'mensual', $customersTotalByMarketing->toArray(), $phone);
        }
        //$message->prospectsDaily(0, 0, 0);
        $data = [
            'code' => 200,
            'message' => 'Notification sending'
        ];

        return response()->json($data, $data['code']);
    }



    public function checkMessage($id){
        $user = User::find($id);
        $message = new WhatsAppChannel();

        $phone = $user->public_phone ? $user->public_phone : $user->personal_phone;

        $message->sendMessage($phone, "Prueba de mensaje");

        return;
    }


    public function terminal()
    {
        $start = Carbon::today('America/New_York');
        $today = Carbon::today('America/New_York');
        $end = Carbon::today('America/New_York')->endOfDay();

        // Convert those times to EST
        $start->timezone('EST');
        $end->timezone('EST');
        $userId = 10;

        $arrayResult = [];
        $message = new WhatsAppChannel;
        $olderThanFiveDays = Carbon::now()->subDays(5)->toDateTimeString();
        $users = User::where('departament_id', '=', 4)->orWhere('departament_alt_id', '=', 4)->get();
        $leaderSalesPhone = '+5219841533143';

        foreach( $users as $user) {

            $phoneUser = $user->public_phone ? $user->public_phone : $user->personal_phone;

            $vendorArray = [
                'vendor' => $user->name
            ];

            $customersOutdated = Customer::Where('vendor_id', '=', $user->id)
            ->where('status', '!=', 4)
            ->where('status', '!=', 5)
            ->where('status', '!=', 6)
            ->where('updated_at', '<',  $olderThanFiveDays)
            //->join('users', 'users.id', '=', $user->id)
            //->groupBy('customers.status')
            //->select(DB::raw('count(*) as total'), 'customers.status')
            ->select('customers.name', 'customers.status')
            //->whereBetween('customers.created_at', [$start, $end])
            ->get();

            $customersOutdatedByVendor = Customer::Where('vendor_id', '=', $user->id)
            ->where('status', '!=', 4)
            ->where('status', '!=', 5)
            ->where('status', '!=', 6)
            ->where('updated_at', '<',  $olderThanFiveDays)
            //->join('users', 'users.id', '=', $user->id)
            ->groupBy('customers.status')
            ->select(DB::raw('count(*) as total'), 'customers.status')
            //->select('customers.name', 'customers.status')
            //->whereBetween('customers.created_at', [$start, $end])
            ->get();

            if(count($customersOutdated)){
                //sending whatsapp to user
                $vendorArray = [...$vendorArray, 'customersOutdated' => $customersOutdatedByVendor];
                $arrayResult = [...$arrayResult, $vendorArray];
                $message->sendOutdatedCustomersMessage($phoneUser, $customersOutdated);

            }

        }

        //to Selene
        $message->sendOutdatedCustomersMessage($leaderSalesPhone, $arrayResult, true);





        $data = [
            'code' => 200,
            'result' => $arrayResult,
        ];

        return response()->json($data, $data['code']);
    }

    public function checkemail($id)
    {
        $user = User::find($id);

        $correo = new CheckMail();
        Mail::to($user->email)->send($correo);
        return;
    }
}
