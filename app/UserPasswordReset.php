<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPasswordReset extends Model
{
    protected $table = 'user_password_resets';
    protected $fillable = [
        'email',
        'token'
    ];
}
