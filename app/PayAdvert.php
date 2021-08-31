<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayAdvert extends Model
{
    protected $table = 'pay_adverts';
    protected $fillable = [
        'advert_type_id',
        'amount',
        'pay_code'
    ];
}
