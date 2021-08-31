<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $type;
    protected $data;
    public function __construct($type, $data)
    {
        $this->type = $type; 
        $this->data = $data; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        
        return $this->from('service@yetecan.com', 'Yetecan.com')
                ->subject('Confirmez votre compte.')
                ->view('mails.confirm_user')
                ->with(['data' => $this->data,
                    'message' => $this]); 

        /*
        switch ($this->type) {
            case 'confirm_compte':
                return $this->from('service@yetecan.com', 'Yetecan.com')
                ->subject('Confirmez votre compte.')
                ->view('mails.confirm_user')
                ->with(['message' => $this]);
                break;
            case 'confirm_compte_success':
                return $this->from('service@yetecan.com', 'Yetecan.com')
                ->subject('Votre compte a été confirmé.')
                ->view('mails.confirm_user_response')
                ->with(['message' => $this]);
                break;
            case 'confirm_admin':
                return $this->from('admin@yetecan.com', 'Yetecan.com')
                ->subject('Confirmez votre compte administrateur.')
                ->view('admin.mails.confirm_admin')
                ->with(['message' => $this]);
                break;
            case 'confirm_admin_success':
                return $this->from('admin@yetecan.com', 'Yetecan.com')
                ->subject('Votre compte administrateur a été confirmé.')
                ->view('admin.mails.confirm_admin_response')
                ->with('message', $this);
                break;
            case 'ad_added_success':
                return $this->from('service@yetecan.com', 'Yetecan.com')
                ->subject('Votre annonce a été ajoutée.')
                ->view('mails.ad_added_mail')
                ->with('message', $this);
                break;
            
            default:
                # code...
                break;
        }*/

        /*
        if($this->type === 'newsletter'){
            return $this->from($this->from)
                ->subject($this->subject)
                ->view('admin.modules.newsletter.template_1.newsletter')
                ->with('data', $this->data);
        }*/
    }
}
