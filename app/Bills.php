<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    public $table = "bills";
    public $timestamps = false;    

    function customer(){
        return $this->belongsTo('App\Customers','id_customer','id');
    }

    function products(){
        return $this->belongsToMany('App\Products','bill_detail','id_bill','id_product');
    }
}
