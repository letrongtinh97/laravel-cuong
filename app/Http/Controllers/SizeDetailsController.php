<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Size_Details;
use App\Product;
use App\Size;

class SizeDetailsController extends Controller
{
    //
    public function getAddSizeDetails(){
        $product = Product::orderBy('id' , 'DESC')->get();
        $size    = Size::orderBy('id' , 'DESC')->get();
     	return view('admin.size_details.add', compact('product' , 'size'));
    }

    public function postAddSizeDetails(Request $request){
    	$this->validate($request , 
    		[
    			'size_details_name'  =>   'required | max:50',
    		] , 
    		[
    			'size_details_name.required' =>  'Bạn chưa nhập tên kích cỡ sản phẩm',
    			'size_details_name.max'		 =>	 'Kích cỡ sản phẩm có độ dài tối đa là 50 kí tự',
    		]
    	);
    	
    	$sizedetails = new Size_Details;

    	$sizedetails->name = $request->size_details_name;

    	$checkUniqueSizeType = Size_Details::where('slug' , Str::slug($request->size_details_name , '-'))->first();
    	if ($checkUniqueSizeType) {
    		return Redirect::to('admin/size-details/add')->withErrors('Tên loại kích cỡ đã tồn tại');
    	}else{
    		$sizedetails->slug = Str::slug($request->size_details_name , '-');
    	}

        $sizedetails->product_id = $request->product_id;
        $sizedetails->size_id    = $request->size_id;
    	$sizedetails->status     = $request->size_details_status;
    	$sizedetails->save();

        // echo "<pre>";
        // print_r($sizedetails);
        // echo "</pre>";
    	return Redirect::to('admin/size-details/add')->with('Success','Thêm thành công');
    }

    public function getAllSizeDetails(){
    	$sizedetails = Size_Details::orderBy('id' , 'DESC')->paginate(5);
    	return view('admin.size_details.all' , compact('sizedetails'));
    }

    public function getUnactiveSizeDetails($id){
    	$sizeStatus = Size_Details::where('id' , $id)->update(['status' => 0]);
    	return Redirect::to('admin/size-details/all')->with('Success','Cập nhật trạng thái kiểu kích cỡ thành công');
    }

    public function getActiveSizeDetails($id){
    	$sizeStatus = Size_Details::where('id' , $id)->update(['status' => 1]);
    	return Redirect::to('admin/size-details/all')->with('Success','Cập nhật trạng thái kiểu kích cỡ thành công');
    }

    public function getEditSizeDetails($id){
        $editSizeDetails = Size_Details::where('id' , $id)->first();
        $product  = Product::all();
        $size     = Size::all();
        return view('admin.size_details.edit' , compact('editSizeDetails' , 'product' , 'size'));
    }

    public function postEditSizeDetails(Request $request , $id){      
        $this->validate($request , 
    		[
    			'size_details_name'  =>   'required | max:50',
    		] , 
    		[
    			'size_details_name.required' =>	'Bạn chưa nhập tên màu',
    			'size_details_name.max'		 =>	'Tên màu có độ dài tối đa là 50 kí tự',
    		]
    	);
        $editSizeDetails = Size_Details::where('id' , $id)->update([
            'name'        => $request->size_details_name,
            'slug'        => Str::slug($request->size_details_name , '-'),
            'size_id'     => $request->size_id,
            'product_id'  => $request->product_id,
        ]);
        return Redirect::to('admin/size-details/edit/' . $id)->with('Success' , 'Cập nhật kiểu kích cỡ sản phẩm thành công');
    }

    public function getDeleteSizeDetails($id){
        $delSizetype = Size_Details::where('id' , $id)->delete();
        return Redirect::to('admin/size-details/all')->with('Success' , 'Xóa kiểu kích cỡ thành công');
    }
}