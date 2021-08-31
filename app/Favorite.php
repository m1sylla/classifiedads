<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    protected $table = 'favorites';
    protected $fillable = [
        'compte_id',
        'annonce_id'
    ];
}
