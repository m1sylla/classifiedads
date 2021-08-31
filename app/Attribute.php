<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $table = 'attributes';
    protected $fillable = [
        'name',
        'unit',
        'unit_exposant',
        'possible_values',
        'data_type'
    ];
}
