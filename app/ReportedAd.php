<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportedAd extends Model
{
    
    protected $table = 'reported_ads';

    protected $fillable = [
        'annonce_id',
        'title',
        'message'
    ];
}
