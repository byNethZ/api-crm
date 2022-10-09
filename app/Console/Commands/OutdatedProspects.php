<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\User;
use App\WhatsAppChannel\WhatsAppChannel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OutdatedProspects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificationWhatsApp:outdatedCustomers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $arrayResult = [];
        $message = new WhatsAppChannel;
        $olderThanFiveDays = Carbon::now()->subDays(5)->toDateTimeString();
        $users = User::where('departament_id', '=', 4)->get();
        $usersMarketing = User::where('departament_id', '=', 8)->orWhere('departament_alt_id', '=', 8)->get();
        $leaderSalesPhone = '+14235910238';
        //$leaderSalesPhone = '+5219841533143';

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
            ->select('customers.name', 'customers.status')
            ->get();

            $customersOutdatedByVendor = Customer::Where('vendor_id', '=', $user->id)
            ->where('status', '!=', 4)
            ->where('status', '!=', 5)
            ->where('status', '!=', 6)
            ->where('updated_at', '<',  $olderThanFiveDays)
            ->groupBy('customers.status')
            ->select(DB::raw('count(*) as total'), 'customers.status')
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

        //marketing users
        foreach($usersMarketing as $user ){
            $phoneUser = $user->public_phone ? $user->public_phone : $user->personal_phone;

            $message->sendOutdatedCustomersMessage($phoneUser, $arrayResult, true);
        }

        return 0;
    }
}
