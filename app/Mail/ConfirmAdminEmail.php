<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmAdminEmail extends Mailable 
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mails.confirm_admin')
        ->from('admin@yetecan.com', 'Yetecan.com')
        ->subject('Confirmez votre compte administrateur')
        ->with([
            'message' => $this,
            'data' => $this->data,
            ]);
    }
}
