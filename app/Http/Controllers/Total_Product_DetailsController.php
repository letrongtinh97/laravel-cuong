<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Size_Details;
use App\Product;
use App\Color_Details;
use App\Total_Product_Details;
use Session;

class Total_Product_DetailsController extends Controller
{
    //
    public function getChoseTotalProduct(){
        $product = Product::orderBy('id' , 'DESC')->get();
     	return view('admin.total_product_details.add', compact('product'));
    }

    public function postChoseTotalProduct(Request $request){
    	Session::put('product_id' , $request->product_id);
        return Redirect::to('admin/total-product-details/add-total');
    }

    public function getAddTotalProduct(){
    	$product_id    = Session::get('product_id');
    	$size_details  = Size_Details::where('product_id' , $product_id)->get();
        $color_details = Color_Details::where('product_id' , $product_id)->get();

        return view('admin.total_product_details.add_details' , compact('size_details' , 'color_details'));
    }


    public function postAddTotalProduct(Request $request){
    	$this->validate($request , 
    		[
    			'new'  =>   'required | numeric | gt:0',
    		] , 
    		[
    			'new.required' =>	'Bạn chưa nhập số lượng sản phẩm',
    			'new.numeric'  =>	'Số lượng sản phẩm phải là số',
    			'new.gt'       =>	'Số lượng sản phẩm phải lớn hơn 0',
    		]
    	);

    	$checkUnique = Total_Product_Details::where('product_id', Session::get('product_id'))->where('size_details_id' , $request->size_details_id)->where('color_details_id' , $request->color_details_id)->first();
    	if ($checkUnique) {
    		return Redirect('admin/total-product-details/add-total')->withErrors('Sản phẩm đã có tồn tại số lượng');
    	}

    	$total = new Total_Product_Details;

        $total->product_id       = Session::get('product_id');
        $total->size_details_id  = $request->size_details_id;
    	$total->color_details_id = $request->color_details_id;
    	$total->new              = $request->new;
    	$total->total            = $total->new;

    	$total->save();
    	Session::forget('product_id');
    	return Redirect::to('admin/total-product-details/add')->with('Success','Thêm số lượng sản phẩm thành công');
    }

    public function getAllTotalProduct(){
    	$total = Total_Product_Details::orderBy('id' , 'DESC')->paginate(5);
    	return view('admin.total_product_details.all' , compact('total'));
    }

    public function getEditTotalProduct($id){
        $total   = Total_Product_Details::where('id' , $id)->first();
        // echo "<pre>";
        // print_r($total);
        // echo "</pre>";
        return view('admin.total_product_details.edit' , compact('total'));
    }

    public function postEditTotalProduct(Request $request , $id){      
        $this->validate($request , 
    		[
    			'new'  =>   'required | numeric | gt:0',
    		] , 
    		[
    			'new.required' =>	'Bạn chưa nhập số lượng sản phẩm',
    			'new.numeric'  =>	'Số lượng sản phẩm phải là số',
    			'new.gt'       =>	'Số lượng sản phẩm phải lớn hơn 0',
    		]
    	);
        $editTotal = Total_Product_Details::where('id' , $id)->update([
        	'old'	=>	$request->total,
            'new'	=>	$request->new,
            'total'	=>  $request->total + $request->new,
        ]);

        return Redirect::to('admin/total-product-details/edit/' . $id)->with('Success' , 'Cập nhật kiểu kích cỡ sản phẩm thành công');
    }

    public function getDeleteSizeDetails($id){
        $delSizetype = Total_Product_Details::where('id' , $id)->delete();
        return Redirect::to('admin/total-product-details/all')->with('Success' , 'Xóa thành công');
    }
}
