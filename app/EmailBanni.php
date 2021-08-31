<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailBanni extends Model
{
    
    protected $table = 'emails_bannis';

    protected $fillable = ['email'];
}
