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

    public $checklist;
    public $gifCelebration;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->checklist = $data;
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
