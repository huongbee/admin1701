<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $table = "products";
    public $timestamps = false;
    const UPDATED_AT = 'update_at';

    function pageUrlProduct(){
        return $this->belongsTo('App\PageUrl','id_url','id');
    }

    function categories(){
        return $this->belongsTo('App\Categories','id_type','id');
    }

    function bill(){
        return $this->belongsToMany('App\Bills','bill_detail','id_product','id_bill');
    }

}
