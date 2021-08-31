<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryItemAttribute extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $table = 'category_item_attributes';
    protected $fillable = [
        'category_item_id',
        'attribute_id'
    ];
}
