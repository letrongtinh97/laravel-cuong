<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_Product extends Model
{
    //
    protected $table = 'tbl_category_product';

    public function product(){
    	return $this->hasMany('App\Product' , 'category_id' , 'id');
    }
}
