<?php

namespace App\WhatsAppChannel;

use App\Utils\Utils;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;


//"Symfony\Component\HttpFoundation\Response::setContent(): Argument #1 ($content) must be of type ?string, App\WhatsAppChannel\WhatsAppChannel given, called in /home/yanethz/Escritorio/Bliones/sistema/api-rest-bliones/vendor/laravel/framework/src/Illuminate/Http/Response.php on line 72"

class WhatsAppChannel
{

    public function notifyChangeStatus($userAuth, $customer, $status, $industry){
        $utils = new Utils;
        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

        $industryFormated = $utils->formatIndustry($industry);

        if($userAuth->role_id === 1){
            $messageToLeader = $twilio->messages
            ->create(
                //"whatsapp:+5219841533143", // to
                "whatsapp:+5215538150607", // to
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => "🔃 Se ha modificado el estatus del cliente:\n" . $customer->name . "\n Industria: " . $industryFormated . "\nEstado: " . $status
                ]
            );
        } else {
            $messageToUser = $twilio->messages
            ->create(
                "whatsapp:+5219841533143", // to
                //"whatsapp:+5215538150607", // to
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => "🔃 Se ha modificado el estatus del cliente:\n" . $customer->name .  "\n Industria: " . $industryFormated . "\nEstado: " . $status
                ]
            );

            $messageToLeader = $twilio->messages
            ->create(
                //"whatsapp:+5219841533143", // to
                "whatsapp:+5215538150607", // to
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => "🔃 " . $userAuth->name . " ha modificado el estatus del cliente:\n" . $customer->name .  "\n Industria: " . $industryFormated . "\nEstado: " . $status
                ]
            );
        }

        return true;
    }

    public function notifySaveCustomer($userAuth, $customer, $industry, $interests, $isProspect){
        $utils = new Utils;
        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

        $industryFormated = $utils->formatIndustry($industry);

        if($isProspect){
            $interestsString = '';
            if(isset($interests)){
                foreach($interests as $interest){
                    $oneInterestString = $utils->formatInterests($interest);
                    $interestsString .= $oneInterestString . "\n";
                    $oneInterestString = '';
                }
            }

            $messageNormal = "🔰 Se ha registrado al siguiente prospecto:\n" . $customer->name .  "\nIndustria: " . $industryFormated . "\nIntereses:\n" . $interestsString;
            $messageLeader = "🔰 " . $userAuth->name . " ha registrado al siguiente prospecto:\n" . $customer->name .  "\nIndustria: " . $industryFormated . "\nIntereses:\n" . $interestsString;
        } else {
            $messageNormal = "🥳 Se ha registrado al siguiente cliente:\n" . $customer->name .  "\nIndustria: " . $industryFormated;
            $messageLeader = "🥳 ". $userAuth->name . " ha registrado al siguiente cliente:\n" . $customer->name .  "\nIndustria: " . $industryFormated;
        }

        if($userAuth->role_id === 1){
            $messageToLeader = $twilio->messages
            ->create(
                //"whatsapp:+5219841533143", // to
                "whatsapp:+5215538150607", // to
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => $messageNormal
                ]
            );
        } else {
            $messageToUser = $twilio->messages
            ->create(
                "whatsapp:+5219841533143", // to
                //"whatsapp:+5215538150607", // to
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => $messageNormal
                ]
            );

            $messageToLeader = $twilio->messages
            ->create(
                //"whatsapp:+5219841533143", // to
                "whatsapp:+5215538150607", // to
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => $messageLeader
                ]
            );
        }

        return true;
    }
}
