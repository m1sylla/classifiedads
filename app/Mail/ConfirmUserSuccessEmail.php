<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmUserSuccessEmail extends Mailable 
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this 
     */
    public function build()
    {
        return $this->view('mails.confirm_user_response')
        ->from('service@yetecan.com', 'Yetecan.com')
        ->subject('Votre compte a été confirmé')
        ->with(['message' => $this]);
    }
}
