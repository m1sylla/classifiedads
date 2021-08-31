<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Compte extends Authenticatable
{
    use Notifiable;

    protected $guard = 'compte';

    protected $table = 'comptes';

    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'phone', 
        'gender', 
        'password', 
        'ads_number',
        'avatar',
        'phone_verified',
        'confirmed',
        'last_visit',
        'suspended',
        'deleted'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verifierCompte()
    {
        return $this->hasOne('App\VerifierCompte');
    }

}
