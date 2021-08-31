<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifierCompte extends Model
{
    
    protected $table = 'verifier_comptes';
    protected $fillable = [
        'compte_id', 
        'token'
    ];

    public function compte()
    {
        return $this->belongsTo('App\Compte', 'compte_id');
    }

}
