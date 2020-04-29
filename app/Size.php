<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    //
    protected $table = 'tbl_size';

    public function size_details(){
    	return $this->hasMany('App\Size_Details' , 'size_id' , 'id');
    }
}
