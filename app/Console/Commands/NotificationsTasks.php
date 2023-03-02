<?php

namespace App\Console\Commands;

use App\Models\User;
use App\WhatsAppChannel\WhatsAppChannel;
use Illuminate\Console\Command;

class NotificationsTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificationWhatsApp:activateSystem';

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
        $users = User::where('departament_id', '=', 4)
            ->orWhere('departament_alt_id', '=', 4)
            ->orWhere('departament_id', '=', 8)
            ->orWhere('departament_alt_id', '=', 8)
            ->get();

        foreach ($users as $user) {
            $message = new WhatsAppChannel;
            $message->activeSystemSend($user);
        }

        return 0;
    }
}
