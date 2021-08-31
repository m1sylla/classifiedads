<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{

    

    protected $table = 'annonces';
    protected $fillable = [
        'compte_id',
        'category_item_id',
        'ville_id',
        'sector_name',
        'is_offer',
        'is_new',
        'title',
        'description',
        'price',
        'price_option_id',
        'slug',
        'views',
        'last_visit',
        'suspended',
        'deleted',
        'category_id',
        'region_id',
        'identifiant',
        'ad_email',
        'ad_phone',
        'is_sold',
        'expire_at'
    ];
}
