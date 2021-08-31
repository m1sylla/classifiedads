<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $table = 'category_items';

    protected $fillable = [
        'category_id',
        'name'
    ];
}
