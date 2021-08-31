<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{

    protected $table = 'admin_activities';
    protected $fillable = [
        'admin_id',
        'activity_id',
        'type'
    ];
}
