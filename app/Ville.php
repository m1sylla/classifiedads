<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $table = 'villes';
    protected $fillable = [
        'region_id',
        'name'
    ];
}
