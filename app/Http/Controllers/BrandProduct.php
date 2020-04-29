<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Brand_Product;
use App\Product;

class BrandProduct extends Controller
{
    //
    public function getAddBrandProduct(){
    	return view('admin.brand_product.add');
    }

    public function postAddBrandProduct(Request $request){
    	$this->validate($request , 
    		[
    			'brand_product_name'	=>   'required | min:3 | max:50',
    			'brand_product_desc'	=>   'required | min:3 | max:300',
    		] , 
    		[
    			'brand_product_name.required'	=>	'Bạn chưa nhập tên thương hiệu',
    			'brand_product_name.min'		=>	'Tên thương hiệu phải có ít 3 kí tự',
    			'brand_product_name.max'		=>	'Tên thương hiệu có độ dài tối đa là 50 kí tự',

    			'brand_product_desc.required'	=>	'Bạn chưa nhập mô tả',
    			'brand_product_desc.min'		=>	'Mô tả phải có ít 3 kí tự',
    			'brand_product_desc.max'		=>	'Mô tả có độ dài tối đa là 300 kí tự',
    		]);
    	
    	$BrandProduct = new Brand_Product;

    	$BrandProductName = $request->brand_product_name;
    	$checkUniqueBrand = Brand_Product::where('name' , $BrandProductName)->first();
    	if ($checkUniqueBrand) {
    		return Redirect::to('admin/brand-product/add')->withErrors('Tên thương hiệu đã tồn tại');
    	}else{
    		$BrandProduct->name = $BrandProductName;
    	}

    	$BrandProduct->slug        = Str::slug($BrandProductName , '-');
    	$BrandProduct->description = $request->brand_product_desc;
    	$BrandProduct->status      = $request->brand_product_status;

    	$BrandProduct->save();

    	return Redirect::to('admin/brand-product/add')->with('Success','Thêm thành công');
    }

    public function getAllBrandProduct(){
    	$BrandProduct = Brand_Product::orderBy('id' , 'DESC')->paginate(5);
    	return view('admin.brand_product.all' , compact('BrandProduct'));
    }

    public function getUnactiveBrandProduct($id){
    	$BrandProductStatus = Brand_Product::where('id' , $id)->update(['status' => 0]);
    	return Redirect::to('admin/brand-product/all')->with('Success','Cập nhật trạng thái thương hiệu thành công');
    }

    public function getActiveBrandProduct($id){
    	$BrandProductStatus = Brand_Product::where('id' , $id)->update(['status' => 1]);
    	return Redirect::to('admin/brand-product/all')->with('Success','Cập nhật trạng thái thương hiệu thành công');
    }

    public function getEditBrandProduct($id){
        $editBrand = Brand_Product::where('id' , $id)->first();
        return view('admin.brand_product.edit' , compact('editBrand'));
    }

    public function postEditBrandProduct(Request $request , $id){   
        $this->validate($request , 
    		[
    			'brand_product_name'	=>   'required | min:3 | max:50',
    			'brand_product_desc'	=>   'required | min:3 | max:300',
    		] , 
    		[
    			'brand_product_name.required'	=>	'Bạn chưa nhập tên thương hiệu',
    			'brand_product_name.min'		=>	'Tên thương hiệu phải có ít 3 kí tự',
    			'brand_product_name.max'		=>	'Tên thương hiệu có độ dài tối đa là 50 kí tự',

    			'brand_product_desc.required'	=>	'Bạn chưa nhập mô tả',
    			'brand_product_desc.min'		=>	'Mô tả phải có ít 3 kí tự',
    			'brand_product_desc.max'		=>	'Mô tả có độ dài tối đa là 300 kí tự',
    		]);
        
        $editBrand = Brand_Product::where('id' , $id)->update([
        	'name'        => $request->brand_product_name,
        	'slug'        => Str::slug($request->brand_product_name , '-'),
        	'description' => $request->brand_product_desc,
        ]); 
        return Redirect::to('admin/brand-product/edit/' . $id)->with('Success' , 'Cập nhật thương hiệu thành công');
    }

    public function getDeleteBrandProduct($id){
        if ($checkExist = Product::where('brand_id' , $id)->first()) {
            return Redirect::to('admin/brand-product/all')->withErrors('Bạn không thể xóa thương hiệu này');
        }else{
            $delBrand = Brand_Product::where('id' , $id)->delete();
            return Redirect::to('admin/brand-product/all')->with('Success' , 'Xóa thương hiệu thành công');
        }
    }
}