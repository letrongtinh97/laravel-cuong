<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    //
    protected $table = 'tbl_checkout';

    public function customers(){
    	return $this->belongsTo('App\Customers' , 'customers_id' , 'id');
    }

    public function order(){
    	return $this->hasMany('App\Order' , 'checkout_id' , 'id');
    }
}
