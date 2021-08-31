<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professionnel extends Model
{
    
    protected $table = 'professionnels';

    protected $fillable = [
        'compte_id',
        'category_id',
        'brand',
        'website',
        'description',
        'active',
        'location',
        'logo'
    ];

}
