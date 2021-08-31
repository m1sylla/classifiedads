<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorType extends Model
{
    protected $table = 'sponsor_types';
    protected $fillable = [
        'title',
        'description'
    ];
}
