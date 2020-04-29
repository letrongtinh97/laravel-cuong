<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Color_Details;
use App\Color;
use App\Product;

class ColorDetailController extends Controller
{
    //
    public function getAddColorDetailsProduct(){
        $product = Product::orderBy('id' , 'DESC')->get();
        $color   = Color::orderBy('id' , 'DESC')->get();
     	return view('admin.color_details.add', compact('product' , 'color'));
    }

    public function postAddColorDetailsProduct(Request $request){
    	
    	$colordetails = new Color_Details;

        if ($check = Color_Details::where('product_id' , $request->product_id)->where('color_id' , $request->color_id)->first()) {
            return Redirect::to('admin/color-details/add')->withErrors('Màu của sản phẩm đã tồn tại');
        }else{
            $colordetails->product_id = $request->product_id;
            $colordetails->color_id   = $request->color_id;
            $colordetails->status     = $request->color_details_status;
            $colordetails->save();
        }
    	return Redirect::to('admin/color-details/add')->with('Success','Thêm thành công');
    }

    public function getAllColorDetailsProduct(){
    	$colordetails = Color_Details::orderBy('id' , 'DESC')->paginate(5);
    	return view('admin.color_details.all' , compact('colordetails'));
    }

    public function getUnactiveColorDetailsProduct($id){
    	$colordetailsStatus = Color_Details::where('id' , $id)->update(['status' => 0]);
    	return Redirect::to('admin/color-details/all')->with('Success','Cập nhật trạng thái kiểu màu thành công');
    }

    public function getActiveColorDetailsProduct($id){
    	$colordetailsStatus = Color_Details::where('id' , $id)->update(['status' => 1]);
    	return Redirect::to('admin/color-details/all')->with('Success','Cập nhật trạng thái kiểu màu thành công');
    }

    public function getEditColorDetailsProduct($id){
        $editcolordetails = Color_Details::where('id' , $id)->first();
        $product  = Product::all();
        $color    = Color::all();
        return view('admin.color_details.edit' , compact('editcolordetails' , 'product' , 'color'));
    }

    public function postEditColorDetailsProduct(Request $request , $id){
    	if ($check = Color_Details::where('product_id' , $request->product_id)->where('color_id' , $request->color_id)->first()) {
            return Redirect::to('admin/color-details/add')->withErrors('Màu của sản phẩm đã tồn tại');
        }else{   
            $editcolordetails = Color_Details::where('id' , $id)->update([
                'color_id'    => $request->color_id,
                'product_id'  => $request->product_id,
            ]);
        }
        return Redirect::to('admin/color-details/edit/' . $id)->with('Success' , 'Cập nhật kiểu màu sản phẩm thành công');
    }

    public function getDeleteColorDetailsProduct($id){
        $delSizetype = Color_Details::where('id' , $id)->delete();
        return Redirect::to('admin/color-details/all')->with('Success' , 'Xóa kiểu màu thành công');
    }
}
