<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPhotos extends Model
{
    protected $table = 'user_photos';    
    protected $fillable = [
        'user_id','photos'
    ];
}
