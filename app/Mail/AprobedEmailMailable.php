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
        $this->urlGif = $this->urlGifArray[rand(0,5)];
        $this->approver = $data->approver;
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
}
