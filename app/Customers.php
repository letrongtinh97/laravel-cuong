<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    //
    protected $table = 'tbl_customers';

    public function order(){
    	return $this->hasMany('App\Order' , 'customers_id' , 'id');
    }

    public function checkout(){
    	return $this->hasMany('App\Checkout' , 'customers_id' , 'id');
    }

    public function chosen(){
    	return $this->hasMany('App\Chosen' , 'customers_id' , 'id');
    }

    public function comment(){
        return $this->hasMany('App\Chosen' , 'customers_id' , 'id');
    }
}
