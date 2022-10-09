<?php

namespace App\WhatsAppChannel;

use App\Models\User;
use App\Utils\Utils;
use Exception;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

use function PHPUnit\Framework\isNull;

class WhatsAppChannel
{
    private $utils;
    private $twilio;
    public $salesLeaderPhone;
    public $menusLeaderPhone;
    public $ceoPhone;

    function __construct(){
        $this->utils = new Utils;
        $this->twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
        $this->salesLeaderPhone = '+14235910238';
        $this->menusLeaderPhone = '+5216441003044';
        $this->ceoPhone = '+14234322492';

        //$this->salesLeaderPhone = '+5219841533143';
        //$this->menusLeaderPhone = '+5219841533143';
        //$this->ceoPhone = '+5219841533143';

    }

    public function notifyChangeStatus($userAuth, $customer, $status, $industry)
    {


        $industryFormated = $this->utils->formatIndustry($industry);
        $user = User::find($userAuth->id);

        $phoneUser = $user->public_phone ? $user->public_phone : $user->personal_phone;

        $messageUser = "🔃 Has modificado el estatus del cliente:\n" . $customer->name . "\n Industria: " . $industryFormated . "\nEstado: " . $status;
        $messageLeader = "🔃 " . $userAuth->name . " ha modificado el estatus del cliente:\n" . $customer->name .  "\n Industria: " . $industryFormated . "\nEstado: " . $status;

        if ($userAuth->role_id === 1) {

            $this->sendMessage($phoneUser, $messageUser);

        } else {

            $this->sendMessage($phoneUser, $messageUser);
            $this->sendMessage($this->salesLeaderPhone, $messageLeader);
        }

        return true;
    }

    public function notifySaveCustomer($userAuth, $customer, $industry, $interests, $isProspect)
    {


        $industryFormated = $this->utils->formatIndustry($industry);
        $user = User::find($userAuth->id);

        $phoneUser = $user->public_phone ? $user->public_phone : $user->personal_phone;

        if ($isProspect) {
            $interestsString = '';
            if (isset($interests)) {
                foreach ($interests as $interest) {
                    $oneInterestString = $this->utils->formatInterests($interest);
                    $interestsString .= $oneInterestString . "\n";
                    $oneInterestString = '';
                }
            }

            $messageNormal = "🔰 Has registrado al siguiente prospecto:\n" . $customer->name .  "\nIndustria: " . $industryFormated . "\nIntereses:\n" . $interestsString;

            if($user->departament_id === 8 || $user->departament_alt_id === 8 ){

                $vendor = User::find($customer->vendor_id);
                $messageNormal .= "\nAsignado a: " . $vendor->name;
                $messageLeader = "🔰 " . $userAuth->name . ", del Departamento de Marketing, ha registrado al siguiente prospecto:\n" . $customer->name .  "\nIndustria: " . $industryFormated . "\nIntereses:\n" . $interestsString . "\nAsignado a: " . $vendor->name;

            } else {

                $messageLeader = "🔰 " . $userAuth->name . " ha registrado al siguiente prospecto:\n" . $customer->name .  "\nIndustria: " . $industryFormated . "\nIntereses:\n" . $interestsString;
            }

        } else {
            $messageNormal = "🥳 Has registrado al siguiente cliente:\n" . $customer->name .  "\nIndustria: " . $industryFormated;
            $messageLeader = "🥳 " . $userAuth->name . " ha registrado al siguiente cliente:\n" . $customer->name .  "\nIndustria: " . $industryFormated;
        }

        if ($userAuth->role_id === 1) {
            $this->sendMessage($phoneUser, $messageNormal);
        } else {

            $this->sendMessage($phoneUser, $messageNormal);
            $this->sendMessage($this->salesLeaderPhone, $messageLeader);
        }

        return true;
    }

    public function activeSystemSend($user)
    {


        $phoneUser = $user->public_phone ? $user->public_phone : $user->personal_phone;

        $message = 'Hola ' . $user->name . ', ¿Te gustaría recibir mensajes hoy de Bliones LLC? Si es afirmativo responde a este mensaje. En caso contrario no es necesario que respondas.';

        $this->sendMessage($phoneUser, $message);
    }

    public function notifyStatusChecklist($user, $aprobedEmailUpdate)
    {


        $phoneUser = $user->public_phone ? $user->public_phone : $user->personal_phone;

        $status = 'Pendiente';

        if ($aprobedEmailUpdate->aprobed == 1) {
            $status = 'Aprobado';
        }

        if ($aprobedEmailUpdate->aprobed == 2) {
            $status = 'Rechazado';
        }

        $icono = $aprobedEmailUpdate->aprobed == 1 ? '🥳' : '❗';
        $iconsCelebration = $aprobedEmailUpdate->aprobed == 1 ? "🎊" : '';

        $messageNormal = $icono . ' El cliente *_' . $aprobedEmailUpdate->customer . '_* ha indicado que su proyecto está *' . $status . "*\nEl proyecto fue revisado por: *" . $aprobedEmailUpdate->approver . "*";

        if ($aprobedEmailUpdate->aprobed == 2) {
            $messageNormal .= "\nObservaciones del cliente: \n" . $aprobedEmailUpdate->message;
        }

        $messageLeader = $messageNormal . "\n" . $iconsCelebration . " _Proyecto de: " . $user->name . $iconsCelebration . "_";

        if ($user->role_id === 1) {

            $this->sendMessage($phoneUser, $messageNormal);

        } else {
            $this->sendMessage($phoneUser, $messageNormal);
            $this->sendMessage($this->menusLeaderPhone, $messageLeader);
        }
    }

    public function prospectsDaily($total, $data, $totalDigital, $lapse, $dataMarketing, $phone = null)
    {
        $leaderPhone = isNull($phone) ? $this->menusLeaderPhone : $phone;

        $messageLeader = "Reporte ".$lapse." de prospectos\n📥 Prospectos nuevos totales - " . $total->total. "\n✅ Prospectos individuales\n";

        foreach ($data as $value) {
            $statusString = "";
            $arrayStatus = $value['status'];

            foreach ($arrayStatus as $status) {
                $statusString .= $status->total . " " . $this->utils->formatStatusEmoticons($status->status) . ", ";
            }

            $messageLeader .= $value['name'] . " (" . $value['total'] . ") - " . $statusString . "\n";
            $statusString = "";
        }

        $messageLeader .= "Total de prospectos desde Marketing: " . $totalDigital->total . "\n";

        foreach( $dataMarketing as $value ) {

            $messageLeader .= $value->name . ": " . $value->total . "\n";
            //$messageLeader .= $value['name'];

        }

        /*
            Reporte diario de prospectos
            📥Prospectos nuevos totales - <numero de registros nuevos del día>
            ✅Prospectos individuales
            Mary- 5 🆕, 2 📞, 1 🔄, 3 🤝
            Vania- 5 🆕, 2 📞, 1 🔄, 3 🤝
            Landa- 5 🆕, 2 📞, 1 🔄, 3 🤝
            EJ- 5 🆕, 2 📞, 1 🔄, 3 🤝
            Selene- 5 🆕, 2 📞, 1 🔄, 3 🤝
            Digital- 5 🆕, 2 📞, 1 🔄, 3 🤝
        */

        $this->sendMessage($leaderPhone, $messageLeader);

        return true;
    }

    public function sendOutdatedCustomersMessage($phone, $outdatedCustomers, $toLeader = false){

        if(!$toLeader){
            $message = "Tienes desactualizados los siguientes clientes\n\n";

            foreach($outdatedCustomers as $statusData){
                $message .= $this->utils->formatStatusEmoticons($statusData->status) . ": " . $statusData->name . "\n";
            }

            $message .= "\nPuedes revisarlos de manera detallada en tu panel de prospectos";
        } else {
            $message = "Están desactualizados los siguiente clientes\n\n";

            foreach($outdatedCustomers as $statusData){
                $message .= "\n" . $statusData['vendor'] . ":\n";

                foreach($statusData['customersOutdated'] as $customers){
                    $message .= $this->utils->formatStatus($customers->status, true) . ": " . $customers->total . "\n";
                }
            }

            $message .= "\nPuedes revisarlos de manera detallada en tu panel de prospectos";


        }


        try {
            $messageSended = $this->twilio->messages
            ->create(

                "whatsapp:" . $phone, // to
                [
                    "from" => "whatsapp:+5215577518523",
                    "body" => $message
                ]
            );
        } catch (Exception $e) {
            echo 'Error is: ',  $e->getMessage(), "\n";
        }
    }

    public function sendMessage(string $phoneNumber, string $messageForSend){

        try {
            $messageSended = $this->twilio->messages
            ->create(

                "whatsapp:" . $phoneNumber, // to
                [
                    "from" => "whatsapp:+5215577518523",
                    "body" => $messageForSend
                ]
            );
        } catch (Exception $e) {
            echo 'Error is: ',  $e->getMessage(), "\n";
        }
    }
}
