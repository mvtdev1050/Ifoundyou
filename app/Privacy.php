<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
   protected $table = 'privacies';   
   protected $fillable = [
        'email_privacy','phone_privacy','photos_privacy','friends_privacy','user_id'
    ]; 
}
