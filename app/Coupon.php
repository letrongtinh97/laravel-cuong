<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $table = 'tbl_coupon';

    public function order(){
    	return $this->hasMany('App\Order' , 'coupon_id' , 'id');
    }
}
