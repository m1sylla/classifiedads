<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;


    protected $guard = 'admin';

    protected $table = 'admins';

    protected $fillable = [
        'email', 
        'name', 
        'level', 
        'password',
        'confirmed',
        'suspended'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verifierAdmin()
    {
        return $this->hasOne('App\VerifierAdmin');
    }
}
