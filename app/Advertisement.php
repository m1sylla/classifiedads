<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{


    protected $table = 'advertisements';
    protected $fillable = [
        'pay_code',
        'advertisement_type_id',
        'image_link',
        'end_at'
    ];
}
