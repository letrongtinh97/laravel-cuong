<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color_Details extends Model
{
    //
    protected $table = 'tbl_color_details';

    public function color(){
    	return $this->belongsTo('App\Color' , 'color_id' , 'id');
    }

    public function product(){
    	return $this->belongsTo('App\Product' , 'product_id' , 'id');
    }

    public function order_details(){
    	return $this->hasMany('App\Order_Details' , 'size_color_id' , 'id');
    }

    public function total_product_details(){
        return $this->hasMany('App\Total_Product_Details' , 'color_details_id' , 'id');
    }
}
