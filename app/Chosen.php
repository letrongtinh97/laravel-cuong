<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chosen extends Model
{
    //
    protected $table = 'tbl_chosen';

    public function customers(){
    	return $this->belongsTo('App\Customers' , 'customers_id' , 'id');
    }

    public function product(){
    	return $this->belongsTo('App\Product' , 'product_id' , 'id');
    }

}
