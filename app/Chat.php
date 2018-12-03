<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
   protected $table = 'chats';   
    protected $fillable = [
        'sender_id','receiver_id','message','status'
    ]; 

    public function getSender() {
        return $this->hasOne('App\User','id','sender_id');
    }

    public function getReceiver() {
        print_r('test');
        return $this->hasOne('App\User','id','sender_id');
    }
}
