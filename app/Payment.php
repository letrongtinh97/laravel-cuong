<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = 'tbl_payment';

    public function order(){
    	return $this->hasMany('App\order' , 'payment_id' , 'id');
    }
}
