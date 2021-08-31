<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifierAdmin extends Model
{
    protected $table = 'verifier_admins';
    protected $fillable = [
        'admin_id', 
        'token'
    ];

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id');
    }
}
