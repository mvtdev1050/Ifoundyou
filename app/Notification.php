<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $table = 'notifications';    
    protected $fillable = [
        'sender_id','receiver_id','action','status'
    ];

    public function getUser() {
        return $this->hasOne('App\User','id','sender_id');
    }
}
