<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $table = 'friends';    
    protected $fillable = [
        'sender_id','receiver_id','action'
    ];

    public function getUser() {
        return $this->hasOne('App\User','id','receiver_id');
    }

    public function getSendRequestUser() {
        return $this->hasOne('App\User','id','sender_id');
    }

    public function getApprovedFriends() {
    	return $this->hasOne('App\User','id','receiver_id');;
    }

}
