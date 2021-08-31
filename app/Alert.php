<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{


    protected $table = 'alerts';
    protected $fillable = [
        'category_id',
        'ville_id',
        'email',
        'phone',
        'expire_at'
    ];
}
