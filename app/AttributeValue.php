<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{

    

    protected $table = 'attribute_values';
    protected $fillable = [
        'annonce_id',
        'attribute_id', 
        'value'
    ];
}
