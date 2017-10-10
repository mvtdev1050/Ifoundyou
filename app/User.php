<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','first_name','last_name','user_type', 'email','dob','cafe','zipcode','dobnumber','password','simple_pass','Account_activate','confirmed','activation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function location()
    {
        return $this->hasMany('App\UserLocation','uid','id');
    }

    
}
