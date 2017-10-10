<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PageCms extends Model
{
    protected $table = 'ifound_pages';    
    protected $fillable = [
        'title','slug','description','publish','menu','order_number'
    ];

    public function Allpages(){
    	$data = PageCms::all();
        return $data;
    }
    public function Allpagesheader(){
        $data = DB::select( DB::raw("SELECT * FROM ifound_pages WHERE find_in_set('publish',publish) AND find_in_set('header-menu',menu)"));
        return $data;
    }
    public function AllpagesFooter(){
         $data = DB::select( DB::raw("SELECT * FROM ifound_pages WHERE find_in_set('publish',publish) AND find_in_set('footer-menu',menu)"));
        return $data;
    }

   

}
  