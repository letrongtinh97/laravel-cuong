<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Details extends Model
{
    //
    protected $table = 'tbl_order_details';

    public function order(){
    	return $this->belongsTo('App\Order' , 'order_id' , 'id');
    }

    public function product(){
    	return $this->belongsTo('App\Product' , 'product_id' , 'id');
    }

    public function color_details(){
    	return $this->belongsTo('App\Color_Details' , 'size_color_id' , 'id');
    }

    public function size_details(){
    	return $this->belongsTo('App\Size_Details' , 'size_details_id' , 'id');
    }
}
