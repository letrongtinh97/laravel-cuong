<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Coupon;

class CouponController extends Controller
{
    //
    public function getAddCoupon(){
    	return view('admin.coupon.add');
    }

    public function postAddCoupon(Request $request){
    	$this->validate($request , 
    		[
    			'name'	 =>  'required | min:3 | max:50',
    			'code'	 =>  'required | min:5 | max:20',
                'time'   =>  'required | numeric',
                'number' =>  'required | numeric',
    		] , 
    		[
    			'name.required'	  =>	'Bạn chưa nhập tên mã giảm giá',
    			'name.min'		  =>	'Tên mã giảm giá phải có ít 3 kí tự',
    			'name.max'		  =>	'Tên mã giảm giá có độ dài tối đa là 50 kí tự',

    			'code.required'	  =>	'Bạn chưa nhập mã giảm giá',
    			'code.min'		  =>	'Mã giảm giá phải có ít 5 kí tự',
    			'code.max'		  =>	'Mã giảm giá có độ dài tối đa là 50 kí tự',

                'time.required'   => 	'Bạn chưa nhập số lượng mã',
                'time.numeric'    => 	'Số lượng mã phải là số',

                'number.required' => 	'Bạn chưa nhập số % hoặc số tiền giảm',
                'number.numeric'  => 	'Số % hoặc số tiền giảm phải là số',
    		]
    	);
    	if($request->condition == 0){
    		return Redirect::to('admin/coupon/add')->withErrors('Bạn chưa chọn tính năng mã');
    	}elseif ($check = Coupon::where('code' , $request->code)->first()) {
    		return Redirect::to('admin/coupon/add')->withErrors('Mã giảm giá đã tồn tại');
    	}else{
    		$coupon = new Coupon;
	    	$coupon->name = $request->name;
	    	$coupon->code = $request->code;
	    	$coupon->time = $request->time;
	    	$coupon->condition = $request->condition;
	    	$coupon->number    = $request->number;
	    	// echo "<pre>";
	    	// print_r($coupon);
	    	// echo "</pre>";
	    	$coupon->save();
	    	return Redirect::to('admin/coupon/add')->with('Success' , 'Thêm mã sản phẩm thành công');
    	}
    }

    public function getAllCoupon(){
    	$coupon = Coupon::orderBy('created_at' , 'DESC')->paginate(5);
    	return view('admin.coupon.all' , compact('coupon'));
    }

    public function getDeleteCoupon($id){
    	$coupon = Coupon::where('id' , $id)->delete();
    	return Redirect::to('admin/coupon/all')->with('Success' , 'Xóa mã sản phẩm thành công');
    }
}
