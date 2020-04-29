<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Category_Product;
use App\Product;

class CategoryProduct extends Controller
{
    //
    public function getAddCateProduct(){
    	return view('admin.category_product.add');
    }

    public function postAddCateProduct(Request $request){
    	$this->validate($request , 
    		[
    			'category_product_name'  =>   'required | min:3 | max:50',
    			'category_product_desc'  =>   'required | min:3 | max:300',
    		] , 
    		[
    			'category_product_name.required'	=>	'Bạn chưa nhập tên danh mục',
    			'category_product_name.min'			=>	'Tên danh mục phải có ít 3 kí tự',
    			'category_product_name.max'			=>	'Tên danh mục có độ dài tối đa là 50 kí tự',

    			'category_product_desc.required'	=>	'Bạn chưa nhập mô tả',
    			'category_product_desc.min'			=>	'Mô tả phải có ít 3 kí tự',
    			'category_product_desc.max'			=>	'Mô tả có độ dài tối đa là 300 kí tự',
    		]);
    	
    	$cateProduct = new Category_Product;

    	$cateProductName    = $request->category_product_name;
    	$checkUniqueCatePro = Category_Product::where('name' , $cateProductName)->first();
    	if ($checkUniqueCatePro) {
    		return Redirect::to('admin/category-product/add')->withErrors('Tên danh mục đã tồn tại');
    	}else{
    		$cateProduct->name = $cateProductName;
    	}

        $cateProduct->slug        = Str::slug($request->category_product_name , '-');
    	$cateProduct->description = $request->category_product_desc;
    	$cateProduct->status      = $request->category_product_status;

    	$cateProduct->save();

    	return Redirect::to('admin/category-product/add')->with('Success','Thêm thành công');
    }

    public function getAllCateProduct(){
    	$cateProduct = Category_Product::orderBy('id' , 'DESC')->paginate(5);
    	return view('admin.category_product.all' , compact('cateProduct'));
    }

    public function getUnactiveCateProduct($id){
    	$cateProductStatus = Category_Product::where('id' , $id)->update(['status' => 0]);
    	return Redirect::to('admin/category-product/all')->with('Success','Cập nhật trạng thái danh mục thành công');
    }

    public function getActiveCateProduct($id){
    	$cateProductStatus = Category_Product::where('id' , $id)->update(['status' => 1]);
    	return Redirect::to('admin/category-product/all')->with('Success','Cập nhật trạng thái danh mục thành công');
    }

    public function getEditCateProduct($id){
        $editCate = Category_Product::where('id' , $id)->first();
        return view('admin.category_product.edit' , compact('editCate'));
    }

    public function postEditCateProduct(Request $request , $id){      
        $this->validate($request , 
            [
                'category_product_name'  =>   'required | min:3 | max:50',
                'category_product_desc'  =>   'required | min:3 | max:300',
            ] , 
            [
                'category_product_name.required'    =>  'Bạn chưa nhập tên danh mục',
                'category_product_name.min'         =>  'Tên danh mục phải có ít 3 kí tự',
                'category_product_name.max'         =>  'Tên danh mục có độ dài tối đa là 50 kí tự',

                'category_product_desc.required'    =>  'Bạn chưa nhập mô tả',
                'category_product_desc.min'         =>  'Mô tả phải có ít 3 kí tự',
                'category_product_desc.max'         =>  'Mô tả có độ dài tối đa là 300 kí tự',
            ]);

        $editCate = Category_Product::where('id' , $id)->update([
            'name'        => $request->category_product_name,
            'slug'        => Str::slug($request->category_product_name , '-'),
            'description' => $request->category_product_desc,
        ]);
        return Redirect::to('admin/category-product/edit/' . $id)->with('Success' , 'Cập nhật danh mục thành công');
    }

    public function getDeleteCateProduct($id){
        if ($checkExist = Product::where('category_id' , $id)->first()) {
            return Redirect::to('admin/category-product/all')->withErrors('Bạn không thể xóa danh mục này');
        }else{
            $delCate = Category_Product::where('id' , $id)->delete();
            return Redirect::to('admin/category-product/all')->with('Success' , 'Xóa danh mục thành công');
        }  
    }
}
