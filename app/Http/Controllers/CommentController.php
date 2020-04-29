<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Comment;
use App\Category_Product;
use App\Brand_Product;
use App\Product;
use App\Size_Details;
use App\Color_Details;
use App\Chosen;


class CommentController extends Controller
{
    //
    public function postCommentAdd(Request $request){
    	$this->validate($request , 
    		[
    			'content'	=>	'required | max: 500'
    		] , 
    		[
				'content.required'	=>	'Bạn chưa nhập bình luận',
				'content.max'		=>	'Bình luận tối đa được 500 kí tự'    			
    		]
    	);
        if (checkScript($request->content) == true) {
            $productDetail  = Product::where('id' , '=' , $request->product_id)->first();
            $commentPro     = Comment::where('product_id' , $request->product_id)->orderBy('created_at' , 'DESC')->get();
            $proChosen      = Chosen::where('product_id' , $request->product_id)->where('status' , 1)->get();

            $productBrand1  = Product::where('brand_id' , '=' , $productDetail->brand_product->id)->where('category_id' , '=' , $productDetail->category_product->id)->whereNotIn('id' , [$request->product_id])->take(3)->get();
            $productBrand2  = Product::where('brand_id' , '=' , $productDetail->brand_product->id)->where('category_id' , '=' , $productDetail->category_product->id)->whereNotIn('id' , [$request->product_id])->skip(3)->take(3)->get();
     
            view('pages.details.product_details' , compact('productDetail' , 'productBrand1' , 'productBrand2' , 'proChosen' , 'commentPro'));
            return Redirect::to('/chi-tiet-san-pham/' . $request->product_id . '/' . $request->slug)->withErrors('Không được phép nhập script');
        }else{
            $comment = new Comment;

            $comment->content      = $request->content;
            $comment->customers_id = $request->customers_id;
            $comment->product_id   = $request->product_id;
            $comment->save();


            $productDetail  = Product::where('id' , '=' , $comment->product_id)->first();
            $prodSizeDetail = Size_Details::where('product_id' , '=' , $comment->product_id)->get();
            $proChosen      = Chosen::where('product_id' , $comment->product_id)->where('status' , 1)->get();
            $commentPro     = Comment::where('product_id' , $comment->product_id)->orderBy('created_at' , 'DESC')->get();

            $productBrand1  = Product::where('brand_id' , '=' , $productDetail->brand_product->id)->where('category_id' , '=' , $productDetail->category_product->id)->whereNotIn('id' , [$comment->product_id])->take(3)->get();
            $productBrand2  = Product::where('brand_id' , '=' , $productDetail->brand_product->id)->where('category_id' , '=' , $productDetail->category_product->id)->whereNotIn('id' , [$comment->product_id])->skip(3)->take(3)->get();
     
            view('pages.details.product_details' , compact('productDetail' , 'productBrand1' , 'productBrand2' , 'proChosen'));
            return Redirect::to('/chi-tiet-san-pham/' . $comment->product_id . '/' . $request->slug)->with('Success' , 'Bình luận thành công');
        }
    }
}
