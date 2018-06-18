<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public $table = "customers";  
    public $timestamps = false;
    
    function billDetail(){
        return $this->hasManyThrough('App\BillDetail','App\Bills','id_customer','id_bill','id','id');
    }
}
