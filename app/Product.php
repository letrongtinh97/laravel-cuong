<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'tbl_product';

    public function category_product(){
    	return $this->belongsTo('App\Category_Product' , 'category_id' , 'id');
    }

    public function brand_product(){
    	return $this->belongsTo('App\Brand_Product' , 'brand_id' , 'id');
    }

    public function color_details(){
        return $this->hasMany('App\Color_Details' , 'product_id' , 'id');
    }

    public function size_details(){
        return $this->hasMany('App\Size_Details' , 'product_id' , 'id');
    }

    public function order_details(){
    	return $this->hasMany('App\Order_Details' , 'product_id' , 'id');
    }

    public function total_product_details(){
        return $this->hasMany('App\Total_Product_Details' , 'product_id' , 'id');
    }

    public function chosen(){
        return $this->hasMany('App\Chosen' , 'product_id' , 'id');
    }

    public function comment(){
        return $this->hasMany('App\Comment' , 'product_id' , 'id');
    }
}
