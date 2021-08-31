<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewAdProcess extends Model    
{
    protected $table = 'new_ad_processes';

    protected $fillable = [
        'annonce_id', 
        'token'
    ];
}
