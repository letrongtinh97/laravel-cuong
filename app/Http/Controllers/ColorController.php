<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Color;
use App\Color_Details;

class ColorController extends Controller
{
    //
    public function getAddColorProduct(){
    	return view('admin.color.add');
    }

    public function postAddColorProduct(Request $request){
    	$this->validate($request , 
    		[
    			'color_product_name'  =>   'required | min:3 | max:50',
    		] , 
    		[
    			'color_product_name.required'	=>	'Bạn chưa nhập tên màu',
    			'color_product_name.min'		=>	'Tên màu phải có ít 3 kí tự',
    			'color_product_name.max'		=>	'Tên màu có độ dài tối đa là 50 kí tự',
    		]
    	);
    	
    	$colorProduct = new Color;

    	$colorProduct->name = $request->color_product_name;

    	$checkUniqueColor = Color::where('slug' , Str::slug($request->color_product_name , '-'))->first();
    	if ($checkUniqueColor) {
    		return Redirect::to('admin/color/add')->withErrors('Tên màu đã tồn tại');
    	}else{
    		$colorProduct->slug = Str::slug($request->color_product_name , '-');
    	}

    	$colorProduct->status = $request->color_product_status;
    	$colorProduct->save();

    	return Redirect::to('admin/color/add')->with('Success','Thêm thành công');
    }

    public function getAllColorProduct(){
    	$color = Color::orderBy('id' , 'DESC')->paginate(5);
    	return view('admin.color.all' , compact('color'));
    }

    public function getUnactiveColorProduct($id){
    	$colorStatus = Color::where('id' , $id)->update(['status' => 0]);
    	return Redirect::to('admin/color/all')->with('Success','Cập nhật trạng thái màu thành công');
    }

    public function getActiveColorProduct($id){
    	$colorStatus = Color::where('id' , $id)->update(['status' => 1]);
    	return Redirect::to('admin/color/all')->with('Success','Cập nhật trạng thái màu thành công');
    }

    public function getEditColorProduct($id){
        $editColor = Color::where('id' , $id)->first();
        return view('admin.color.edit' , compact('editColor'));
    }

    public function postEditColorProduct(Request $request , $id){      
        $this->validate($request , 
    		[
    			'color_product_name'  =>   'required | min:3 | max:50',
    		] , 
    		[
    			'color_product_name.required'	=>	'Bạn chưa nhập tên màu',
    			'color_product_name.min'		=>	'Tên màu phải có ít 3 kí tự',
    			'color_product_name.max'		=>	'Tên màu có độ dài tối đa là 50 kí tự',
    		]
    	);

        $editColor = Color::where('id' , $id)->update([
            'name'        => $request->color_product_name,
            'slug'        => Str::slug($request->color_product_name , '-'),
        ]);
        return Redirect::to('admin/color/edit/' . $id)->with('Success' , 'Cập nhật màu thành công');
    }

    public function getDeleteColorProduct($id){
        if ($checkExist = Color_Details::where('color_id' , $id)->first()) {
            return Redirect::to('admin/color/all')->withErrors('Bạn không thể xóa màu này');
        }else{
            $delColor = Color::where('id' , $id)->delete();
            return Redirect::to('admin/color/all')->with('Success' , 'Xóa màu thành công');
        }     
    }
}
