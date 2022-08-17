<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AprobedEmailMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Checklist Bliones';

    public $customer;

    public $urlGifArray = [
        'https://bliones.net/checklist-menus/cust/public/playground_assets/gif-email/f1.gif',
        'https://bliones.net/checklist-menus/cust/public/playground_assets/gif-email/f2.gif',
        'https://bliones.net/checklist-menus/cust/public/playground_assets/gif-email/f3.gif',
        'https://bliones.net/checklist-menus/cust/public/playground_assets/gif-email/f4.gif',
        'https://bliones.net/checklist-menus/cust/public/playground_assets/gif-email/f5.gif',
        'https://bliones.net/checklist-menus/cust/public/playground_assets/gif-email/f6.gif'
    ];

    public $urlGif;
    public $approver;
    public $gifCelebration;

    /*
    $mail->setFrom('checklist@bliones.com', 'Checklist Menus');
    $mail->addAddress('dbliones@gmail.com');               //Name is optional
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Checklist Bliones';
    $mail->Body    = '<h1 style="text-align:center;">Checklist de seguimiento menus</h1>';
    $mail->Body    .= '<h3 style="text-align:center;">El cliente '. $cliente .' ha confirmado que su proyecto esta aprobado</h3>';
    $mail->AltBody = 'El cliente ' . $cliente . ' ha aprobado el menu en cada uno de los puntos';
    */

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->customer = $data->customer;
        $this->urlGif = $this->urlGifArray[rand(0, 5)];
        $this->approver = $data->approver;
        $this->gifCelebration = $this->returnGif();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.aprobedemail');
    }

    public function returnGif()
    {
        //$json = file_get_contents();
        //$obj = json_decode($json);

        $ch = curl_init();
        // IMPORTANT: the below line is a security risk, read https://paragonie.com/blog/2017/10/certainty-automated-cacert-pem-management-for-php-software
        // in most cases, you should set it to true
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'https://api.giphy.com/v1/gifs/random?api_key=S6Fzm6zZKpoZtXyGoPJ3oRRiCVYJPRRy&tag=celebrating');
        $result = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result);

        return $obj->data->images->original->url;
    }
}
