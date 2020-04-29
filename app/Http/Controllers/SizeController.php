<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Size;
use App\Size_Details;

class SizeController extends Controller
{
    //
    public function getAddSize(){
    	return view('admin.size.add');
    }

    public function postAddSize(Request $request){
    	$this->validate($request , 
    		[
    			'size_name'  =>   'required | min:3 | max:50',
    		] , 
    		[
    			'size_name.required' =>	'Bạn chưa nhập tên kích cỡ',
    			'size_name.min'		 =>	'Tên kích cỡ phải có ít 3 kí tự',
    			'size_name.max'		 =>	'Tên kích cỡ có độ dài tối đa là 50 kí tự',
   			]
    	);
    	
    	$size = new Size;

    	$size->name = $request->size_name;

    	$checkUniqueSize = Size::where('slug' , Str::slug($request->size_name , '-'))->first();
    	if ($checkUniqueSize) {
    		return Redirect::to('admin/size/add')->withErrors('Tên loại kích cỡ đã tồn tại');
    	}else{
    		$size->slug = Str::slug($request->size_name , '-');
    	}

    	$size->status = $request->size_status;
    	$size->save();

    	return Redirect::to('admin/size/add')->with('Success','Thêm thành công');
    }

    public function getAllSize(){
    	$size = Size::orderBy('id' , 'DESC')->paginate(5);
    	return view('admin.size.all' , compact('size'));
    }

    public function getUnactiveSize($id){
    	$sizeStatus = Size::where('id' , $id)->update(['status' => 0]);
    	return Redirect::to('admin/size/all')->with('Success','Cập nhật trạng thái kiểu kích cỡ thành công');
    }

    public function getActiveSize($id){
    	$sizeStatus = Size::where('id' , $id)->update(['status' => 1]);
    	return Redirect::to('admin/size/all')->with('Success','Cập nhật trạng thái kiểu kích cỡ thành công');
    }

    public function getEditSize($id){
        $editSize = Size::where('id' , $id)->first();
        return view('admin.size.edit' , compact('editSize'));
    }

    public function postEditSize(Request $request , $id){      
        $this->validate($request , 
    		[
    			'size_name'  =>   'required | min:3 | max:50',
    		] , 
    		[
    			'size_name.required' =>	'Bạn chưa nhập tên kích cỡ',
    			'size_name.min'		 =>	'Tên kích cỡ phải có ít 3 kí tự',
    			'size_name.max'		 =>	'Tên kích cỡ có độ dài tối đa là 50 kí tự',
   			]
    	);

        $editSize = Size::where('id' , $id)->update([
            'name'        => $request->size_name,
            'slug'        => Str::slug($request->size_name , '-'),
        ]);
        return Redirect::to('admin/size/edit/' . $id)->with('Success' , 'Cập nhật kiểu kích cỡ thành công');
    }

    public function getDeleteSize($id){
        if ($checkExist = Size_Details::where('size_id' , $id)->first()) {
            return Redirect::to('admin/size/all')->withErrors('Bạn không thể xóa kích cỡ này');
        }else{
            $delSize = Size::where('id' , $id)->delete();
            return Redirect::to('admin/size/all')->with('Success' , 'Xóa kiểu kích cỡ thành công');
        }
    }
}
