<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Product;
use App\Category_Product;
use App\Brand_Product;
use App\Color_Details;
use App\Order_Details;
use App\Size_Details;
use App\Total_Product_Details;
use File;

class ProductController extends Controller
{
    //
    public function getAddProduct(){
        $category = Category_Product::all();
        $brand    = Brand_Product::all();
    	return view('admin.product.add' , compact('category' , 'brand'));
    }

    public function postAddProduct(Request $request){
    	$this->validate($request , 
    		[
    			'product_name'	     =>  'required | min:3 | max:50',
    			'product_desc'	     =>  'required | min:3 | max:300',
                'product_image'      =>  'required | mimes:jpeg,jpg,png | max:500',
                'product_unit_price' =>  'required | numeric',
                'product_sale_price' =>  'numeric',
                'product_content'    =>  'required | min:3',
    		] , 
    		[
    			'product_name.required'	 =>	'Bạn chưa nhập tên danh mục',
    			'product_name.min'		 =>	'Tên danh mục phải có ít 3 kí tự',
    			'product_name.max'		 =>	'Tên danh mục có độ dài tối đa là 50 kí tự',

    			'product_desc.required'	 =>	'Bạn chưa nhập mô tả',
    			'product_desc.min'		 =>	'Mô tả phải có ít 3 kí tự',
    			'product_desc.max'		 =>	'Mô tả có độ dài tối đa là 300 kí tự',

                'product_image.required' => 'Bạn chưa nhập hình ảnh',
                'product_image.mimes'    => 'Hình ảnh không hợp lệ',
                'product_image.max'      => 'Hình ảnh có độ dài tối đa là 500 kí tự',

                'product_content.required'     => 'Bạn chưa nhập nội dung',
                'product_content.min'          => 'Nội dung có độ dài tối thiểu là 3 kí tự',

                'product_unit_price.required'  => 'Bạn chưa nhập giá sản phẩm',
                'product_unit_price.numeric'   => 'Giá sản phẩm phải là số',

                'product_sale_price.numeric'   => 'Giá sản phẩm phải là số',
    		]
        );
    	
    	$Product = new Product;

    	$checkUniqueProduct = Product::where('slug' , Str::slug($request->product_name , '-'))->first();
    	if ($checkUniqueProduct) {
    		return Redirect::to('admin/product/add')->withErrors('Tên sản phẩm đã tồn tại');
    	}else{
    		$Product->slug    = Str::slug($request->product_name , '-');
    	}
        $Product->name        = $request->product_name;
        $Product->category_id = $request->product_category;
        $Product->brand_id    = $request->product_brand;
    	$Product->description = $request->product_desc;
        $Product->content     = $request->product_content;
        $Product->unit_price  = $request->product_unit_price;
        $Product->sale_price  = $request->product_sale_price;
    	$Product->status      = $request->product_status;

        $file  = $request->file('product_image');
        $image = $file->getClientOriginalName(); // lấy tên hình
        if (file_exists('public/uploads/products/' . $image)) {
            return Redirect::to('admin/product/add')->withErrors('Hình ảnh đã tồn tại');
        }else{
            $file->move('public/uploads/products/' , $image);
            $Product->image = $image;
        }

    	$Product->save();
    	return Redirect::to('admin/product/add')->with('Success','Thêm sản phẩm thành công');
    }

    public function getAllProduct(){
    	$Product = Product::orderBy('id' , 'DESC')->paginate(10);
    	return view('admin.product.all' , compact('Product'));
    }

    public function getUnactiveProduct($id){
    	$ProductStatus = Product::where('id' , $id)->update(['status' => 0]);
    	return Redirect::to('admin/product/all')->with('Success','Cập nhật trạng thái sản phẩm thành công');
    }

    public function getActiveProduct($id){
    	$ProductStatus = Product::where('id' , $id)->update(['status' => 1]);
    	return Redirect::to('admin/product/all')->with('Success','Cập nhật trạng thái sản phẩm thành công');
    }

    public function getEditProduct($id){
        $category = Category_Product::all();
        $brand    = Brand_Product::all();
        $Product  = Product::where('id' , $id)->first();
        return view('admin.product.edit' , compact('Product' , 'category' , 'brand'));
    }

    public function postEditProduct(Request $request , $id){   
                $this->validate($request , 
            [
                'product_name'       =>  'required | min:3 | max:50',
                'product_desc'       =>  'required | min:3 | max:300',
                'product_image'      =>  'required | mimes:jpeg,jpg,png | max:500',
                'product_unit_price' =>  'required | numeric',
                'product_sale_price' =>  'numeric',
                'product_content'    =>  'required | min:3',
            ] , 
            [
                'product_name.required'  => 'Bạn chưa nhập tên danh mục',
                'product_name.min'       => 'Tên danh mục phải có ít 3 kí tự',
                'product_name.max'       => 'Tên danh mục có độ dài tối đa là 50 kí tự',

                'product_desc.required'  => 'Bạn chưa nhập mô tả',
                'product_desc.min'       => 'Mô tả phải có ít 3 kí tự',
                'product_desc.max'       => 'Mô tả có độ dài tối đa là 300 kí tự',

                'product_image.required' => 'Bạn chưa nhập hình ảnh',
                'product_image.mimes'    => 'Hình ảnh không hợp lệ',
                'product_image.max'      => 'Hình ảnh có độ dài tối đa là 500 kí tự',

                'product_content.required'     => 'Bạn chưa nhập nội dung',
                'product_content.min'          => 'Nội dung có độ dài tối thiểu là 3 kí tự',

                'product_unit_price.required'  => 'Bạn chưa nhập giá sản phẩm',
                'product_unit_price.numeric'   => 'Giá sản phẩm phải là số',

                'product_sale_price.numeric'   => 'Giá sản phẩm phải là số',
            ]);
        $Product = Product::where('id' , $id)->first();

        // check trùng hình thì xóa hình cũ
        $file  = $request->file('product_image');
        $image = $file->getClientOriginalName(); // lấy tên hình ra
        if (file_exists("public/uploads/products/" . $image)) {
            $file->move('public/uploads/products/' , $image);
            if ($Product->image) {
                // xóa file hình cũ trong file uploads nếu file đã tồn tại
                File::delete("public/uploads/products/" . $Product->image); 
                $editProduct = Product::where('id' , $id)->update(['image' => $image]);
            }           
        }else{
            $file->move('public/uploads/products/' , $image);
            $editProduct = Product::where('id' , $id)->update(['image' => $image]);
        }

        $editProduct = Product::where('id' , $id)->update([
        	'name'        => $request->product_name,
        	'slug'        => Str::slug($request->product_name , '-'),
        	'description' => $request->product_desc,
            'content'     => $request->product_content,
            'unit_price'  => $request->product_unit_price,
            'sale_price'  => $request->product_sale_price,
            'category_id' => $request->product_category,
            'brand_id'    => $request->product_brand,
        ]); 
        return Redirect::to('admin/product/edit/' . $id)->with('Success' , 'Cập nhật sản phẩm thành công');
    }

    public function getDeleteProduct($id){
        $proColorD = Color_Details::where('product_id' , $id)->get();
        $proSizeD  = Size_Details::where('product_id' , $id)->get();
        $proOrderD = Order_Details::where('product_id' , $id)->get();
        $proTotal  = Total_Product_Details::where('product_id' , $id)->get();

        if ($proColorD && $proSizeD && $proOrderD && $proTotal) {
            return Redirect::to('admin/product/all')->withErrors('Bạn không thể xóa sản phẩm này');    
        }else{
            $Product = Product::where('id' , $id)->delete();
            return Redirect::to('admin/product/all')->with('Success' , 'Xóa danh mục thành công');
        }    
    }
}
