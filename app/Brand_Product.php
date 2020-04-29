<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand_Product extends Model
{
    //
    protected $table = 'tbl_brand';

    public function product(){
    	return $this->hasMany('App\Product' , 'brand_id' , 'id');
    }
}
