<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceOption extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $table = 'price_options';
    protected $fillable = ['name'];
}
