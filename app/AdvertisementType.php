<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementType extends Model
{
    protected $table = 'advertisement_types';
    protected $fillable = [
        'title',
        'description'
    ];
}
