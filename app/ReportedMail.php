<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportedMail extends Model
{
    
    protected $table = 'reported_mails';

    protected $fillable = [
        'sender_email',
        'receiver_email',
        'message'
    ];

}
