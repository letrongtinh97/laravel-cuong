<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Category_Product;
use App\Brand_Product;
use App\Product;
use App\Size_Details;
use App\Color_Details;
use App\Chosen;
use App\Comment;

class HomeController extends Controller
{

    public function index(){
        $productNew   = Product::where('status' , '=' , 1)->orderBy('id' , 'DESC')->paginate(6);
    	$productSale1 = Product::where('sale_price' , '<>' , 0)->orderBy('updated_at' , 'DESC')->take(3)->get();
    	$productSale2 = Product::where('sale_price' , '<>' , 0)->orderBy('updated_at' , 'DESC')->skip(3)->take(3)->get();
    	return view('pages.home' , compact('productSale1' , 'productSale2' , 'productNew'));
    }

    public function getProductCategory($id){
    	$productCateName = Category_Product::where('id' , '=' , $id)->first();
    	$productCate     = Product::where('category_id' , '=' , $id)->orderBy('id' , 'DESC')->paginate(6);
    	return view('pages.category.product_category' , compact('productCate' , 'productCateName'));
    }

    public function getProductBrand($id){
    	$productBrandName = Brand_Product::where('id' , '=' , $id)->first();
    	$productBrand     = Product::where('brand_id' , '=' , $id)->orderBy('id' , 'DESC')->paginate(6);

    	return view('pages.brand.product_brand' , compact('productBrand' , 'productBrandName'));
    }

    public function getProductDetails($id){
        $productDetail  = Product::where('id' , '=' , $id)->first();
        $proChosen      = Chosen::where('product_id' , $id)->where('status' , 1)->get();
        $commentPro     = Comment::where('product_id' , $id)->orderBy('created_at' , 'DESC')->get();

        $productBrand1  = Product::where('brand_id' , '=' , $productDetail->brand_product->id)->where('category_id' , '=' , $productDetail->category_product->id)->whereNotIn('id' , [$id])->take(3)->get();
        $productBrand2  = Product::where('brand_id' , '=' , $productDetail->brand_product->id)->where('category_id' , '=' , $productDetail->category_product->id)->whereNotIn('id' , [$id])->skip(3)->take(3)->get();
 
        return view('pages.details.product_details' , compact('productDetail' , 'productBrand1' , 'productBrand2' , 'proChosen' , 'commentPro'));
    }

    public function postProductSearch(Request $request){
        $keyword = $request->keyword;
        if ($keyword == '') {
            return Redirect::to('/trang-chu');
        }else{
            $productSearch = Product::where('name' , 'like' , "%$keyword%")->paginate(6);
            return view('pages.search.product_search' , compact('productSearch' , 'keyword'));
        }        
    }
}
