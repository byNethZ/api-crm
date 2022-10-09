<?php

namespace App\Console\Commands;

use App\Utils\Utils;
use App\WhatsAppChannel\WhatsAppChannel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProspectsDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificationWhatsApp:dailyProspects';

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
        $start = Carbon::today('America/New_York');
        $end = Carbon::today('America/New_York')->endOfDay();
        $utils = new Utils();

        // Convert those times to EST
        $start->timezone('EST');
        $end->timezone('EST');

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

        $message = new WhatsAppChannel;
        $message->prospectsDaily($customersTotal[0], $data, $customersTotalDigital[0], 'diario', $customersTotalByMarketing->toArray());

        //Roberto message
        //$message->prospectsDaily($customersTotal[0], $data, $customersTotalDigital[0], 'diario', $customersTotalByMarketing->toArray(), '+5219841533143');
        $message->prospectsDaily($customersTotal[0], $data, $customersTotalDigital[0], 'diario', $customersTotalByMarketing->toArray(), '+14234322492');

        return 0;
    }
}
