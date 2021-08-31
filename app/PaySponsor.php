<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaySponsor extends Model
{
    protected $table = 'pay_sponsors';
    protected $fillable = [
        'sponsor_type_id',
        'amount',
        'pay_code'
    ];
}
