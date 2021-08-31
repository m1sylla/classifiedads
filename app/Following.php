<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $table = 'followings';
    protected $fillable = [
        'is_followed_id',
        'is_following_id'
    ];
}
