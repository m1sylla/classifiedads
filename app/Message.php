<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'compte_id', 
        'annonce_id', 
        'name', 
        'email', 
        'phone', 
        'message', 
        'seen'
    ];
}
