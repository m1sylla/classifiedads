<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPasswordReset extends Model
{
    protected $table = 'admin_password_resets';
    protected $fillable = [
        'email',
        'token'
    ];
}
