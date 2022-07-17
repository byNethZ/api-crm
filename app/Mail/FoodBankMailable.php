<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FoodBankMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Banco de Fotos Bliones';

    public $name;
    public $restaurant;
    public $phone;
    public $email;
    public $photos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->name = $message['name'];
        $this->restaurant = $message['restaurant'];
        $this->phone = $message['phone'];
        $this->email = $message['email'];
        $this->photos = $message['photos'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.foodbank');
    }
}
