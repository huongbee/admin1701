<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageUrl extends Model
{
    public $table = "page_url";
    public $timestamps = false;

    function categories(){
        return $this->hasOne('App\Categories','id_url','id');
    }

    function products(){
        return $this->hasOne('App\Products','id_url','id');
    }
    
}
