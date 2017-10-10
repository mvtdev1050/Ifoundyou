<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
   protected $table = 'templates';    
    protected $fillable = [
        'template_name','template_file'
    ];
}
