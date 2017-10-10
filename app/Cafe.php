<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    protected $table = 'cafe';   

    public function getCafeUser() {
    	return $this->hasMany('App\User','cafe','id');
    }
}
