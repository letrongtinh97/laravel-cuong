<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    protected $table = 'tbl_color';

    public function color_details(){
    	return $this->hasMany('App\Color_Details' , 'color_id' , 'id');
    }
}
