<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
     protected $table = 'gerenal-settings';    
    protected $fillable = [
        'admin_id','site_logo','site_title','footer_setting'
    ];

     public function Footersetting(){
        $footer = Setting::select('footer_setting')->first();
        return $footer;
    }
}
