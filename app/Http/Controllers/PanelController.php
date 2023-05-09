<?php

namespace App\Http\Controllers;

use App\Mail\CheckMail;
use App\Models\Customer;
use App\Models\ProspectInterest;
use App\Models\User;
use App\Utils\Utils;
use App\WhatsAppChannel\WhatsAppChannel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PanelController extends Controller
{
    public function sendReports($id, $mode = 'day')
    {

        $user = User::find($id);
        $utils = new Utils();
        $message = new WhatsAppChannel;

        $phone = $user->public_phone ? $user->public_phone : $user->personal_phone;

        if ($mode === 'month') {

            $now = Carbon::now();
            $start = $now->startOfMonth()->format('Y-m-d H:i');
            $end = $now->endOfMonth()->format('Y-m-d H:i');
        }

        if ($mode === 'week') {
            $now = Carbon::now();
            $start = $now->startOfWeek()->format('Y-m-d H:i');
            $end = $now->endOfWeek()->format('Y-m-d H:i');
        }

        if ($mode === 'day') {
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

        if ($mode === 'day') {
            $message->prospectsDaily($customersTotal[0], $data, $customersTotalDigital[0], 'diario', $customersTotalByMarketing->toArray(), $phone);
        }

        if ($mode === 'week') {
            $message->prospectsDaily($customersTotal[0], $data, $customersTotalDigital[0], 'semanal', $customersTotalByMarketing->toArray(), $phone);
        }

        if ($mode === 'month') {
            $message->prospectsDaily($customersTotal[0], $data, $customersTotalDigital[0], 'mensual', $customersTotalByMarketing->toArray(), $phone);
        }
        //$message->prospectsDaily(0, 0, 0);
        $data = [
            'code' => 200,
            'message' => 'Notification sending'
        ];

        return response()->json($data, $data['code']);
    }



    public function checkMessage($id)
    {
        $user = User::find($id);
        $message = new WhatsAppChannel();

        $phone = $user->public_phone ? $user->public_phone : $user->personal_phone;

        $message->sendMessage($phone, "Testing de mensaje. No contestar. Gracias.");

        return;
    }


    public function terminal()
    {
        $olderThanFiveDays = Carbon::now()->subDays(5)->toDateTimeString();

        $customersOutdated = Customer::Where('vendor_id', '=', 10)
            ->where('status', '!=', 4)
            ->where('status', '!=', 5)
            ->where('status', '!=', 6)
            ->where('updated_at', '<',  $olderThanFiveDays)
            ->groupBy('customers.status')
            ->select(DB::raw('count(*) as total'), 'customers.status')
            ->get();

        $customersOutdatedByVendor = Customer::where('status', '!=', 4)
            ->where('status', '!=', 5)
            ->where('status', '!=', 6)
            ->where('updated_at', '<',  $olderThanFiveDays)
            ->groupBy('customers.status')
            ->select(DB::raw('count(*) as total'), 'customers.status')
            ->get();

        $data = [
            'code' => 200,
            'customersOutdated' => $customersOutdated,
            'customersOutdatedByVendor' => $customersOutdatedByVendor,
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
