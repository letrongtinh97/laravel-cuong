<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Chosen;
use App\Customers;
use App\Product;
use Session;

class ChosenController extends Controller
{
    //
    public function getChosenShow(){
        $customers = Customers::where('id' , Session::get('id'))->first();
        $chosen    = Chosen::where('customers_id' , Session::get('id'))->where('status' , 1)->get();
        return view('pages.chosen.chosen_product' , compact('customers' , 'chosen'));
    }

    public function postChosenAdd(Request $request){
        $customers_id = Session::get('id');
        $product_id   = $request->product_id;
        if ($chosenCheck = Chosen::where('product_id' , $product_id)->where('customers_id' , $customers_id)->where('status' , 1)->first()) {
            return Redirect::to('/chosen/' . $customers_id)->withErrors('Bạn đã thích sản phẩm này rồi');
        }elseif ($chosenCheck = Chosen::where('product_id' , $product_id)->where('customers_id' , $customers_id)->where('status' , 0)->first()) {
            $chosenCheck->status = 1;
            $chosenCheck->save();
            return Redirect::to('/chosen/' . $customers_id)->with('Success', 'Thích sản phẩm thành công');

        }else{
            $chosen = new Chosen;
            $chosen->product_id   = $product_id;
            $chosen->customers_id = $customers_id;
            $chosen->status       = 1;
            $chosen->save();
            return Redirect::to('/chosen/' . $customers_id)->with('Success', 'Thích sản phẩm thành công');
        }
    }

    public function postChosenCancel(Request $request){
        $customers_id = Session::get('id');
        $product_id   = $request->product_id;
        $chosen = Chosen::where('product_id' , $product_id)->where('customers_id' , $customers_id)->update(['status' => 0]);
        return Redirect::to('/chosen/' . $customers_id)->with('Success', 'Bỏ thích sản phẩm thành công');
    }

    public function getAllChosenProductAdmin(){
        $product = Product::orderBy('id' , 'DESC')->paginate(5);
        return view('admin.chosen.all' , compact('product'));
    }
}
