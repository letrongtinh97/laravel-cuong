<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Total_Product_Details extends Model
{
    //
    protected $table = 'tbl_total_product_details';

    public function product(){
    	return $this->belongsTo('App\Product' , 'product_id' , 'id');
    }

    public function color_details(){
    	return $this->belongsTo('App\Color_Details' , 'color_details_id' , 'id');
    }

    public function size_details(){
    	return $this->belongsTo('App\Size_Details' , 'size_details_id' , 'id');
    }
}
