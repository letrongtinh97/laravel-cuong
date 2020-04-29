<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'tbl_order';

    public function checkout(){
    	return $this->belongsTo('App\Checkout' , 'checkout_id' , 'id');
    }

    public function customers(){
    	return $this->belongsTo('App\Customers' , 'customers_id' , 'id');
    }

    public function payment(){
    	return $this->belongsTo('App\Payment' , 'payment_id' , 'id');
    }

    public function coupon(){
        return $this->belongsTo('App\Coupon' , 'coupon_id' , 'id');
    }

    public function order_details(){
    	return $this->hasMany('App\Order_details' , 'order_id' , 'id');
    }
}
