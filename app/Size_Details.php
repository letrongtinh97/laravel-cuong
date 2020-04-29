<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size_Details extends Model
{
    //
    protected $table = 'tbl_size_details';

    public function size(){
    	return $this->belongsTo('App\Size' , 'size_id' , 'id');
    }

    public function product(){
    	return $this->belongsTo('App\Product' , 'product_id' , 'id');
    }

    public function order_details(){
    	return $this->hasMany('App\Order_Details' , 'size_details_id' , 'id');
    }

    public function total_product_details(){
        return $this->hasMany('App\Total_Product_Details' , 'size_details_id' , 'id');
    }
}
