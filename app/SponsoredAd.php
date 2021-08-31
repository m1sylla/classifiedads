<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsoredAd extends Model
{
    
    protected $table = 'sponsored_ads';
    protected $fillable = [
        'annonce_id',
        'sponsor_type_id',
        'pay_code',
        'end_at'
    ];
}
