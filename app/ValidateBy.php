<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidateBy extends Model
{

    protected $table = 'validate_by';
    protected $fillable = [
        'admin_id',
        'activity_id',
        'activity_type'
    ];
}
