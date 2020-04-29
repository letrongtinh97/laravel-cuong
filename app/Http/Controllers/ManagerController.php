<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Order;
use App\Payment;
use App\Checkout;
use App\Order_Details;
use App\Total_Product_Details;
use App\Coupon;

class ManagerController extends Controller
{
    //

    public function getAllManageOrder(){
    	$order = Order::orderBy('created_at' , 'DESC')->where('status' , '=' , 0)->paginate(10);
    	return view('admin.manager.all' , compact('order'));
    }

    public function getDetailsManageOrder($id){
    	$orderDetails   = Order_Details::where('order_id' , '=' , $id)->get();
    	$order          = Order::where('id' , '=' , $id)->first();
    	return view('admin.manager.details' , compact('orderDetails' , 'order'));
    }

    public function postDetailsManageOrder(Request $request){
        for ($i = 0; $i < $request->count ; $i++) {
            if ($orderDetails = Order_Details::where('order_id' , $request->order_id)->where('product_id' , $request->input("product_id_".$i))
                ->where('size_details_id' , $request->input("size_details_id_".$i))
                ->where('size_color_id' , $request->input("color_details_id_".$i))
                ->where('status' , 2)->first()) {
                return Redirect::to('admin/manager/all/sending')->withErrors('Bạn đã check hoàn tất trong chi tiết đơn hàng rồi');
            }else{
                $product_sold = Total_Product_Details::where('product_id' , $request->input("product_id_".$i))
                ->where('size_details_id' , $request->input("size_details_id_".$i))
                ->where('color_details_id' , $request->input("color_details_id_".$i))->first();
                
                $sold = $request->input("qty_".$i);
                $product_sold->sold = $product_sold->sold + $sold;
                if ($product_sold->old < $sold) {
                    $product_sold->total = $product_sold->total - $sold;
                }else{
                    $product_sold->old   = $product_sold->old - $sold;
                    $product_sold->total = $product_sold->total - $sold;
                }
                // echo "<pre>";
                // print_r($product_sold);
                // echo '</pre>';
                $product_sold->save();
                $orderDetails = Order_Details::where('order_id' , $request->order_id)->where('product_id' , $request->input("product_id_".$i))
                ->where('size_details_id' , $request->input("size_details_id_".$i))
                ->where('size_color_id' , $request->input("color_details_id_".$i))->update(['status' => 2]);
            }
        }
        return Redirect::to('admin/manager/all/sending') ->with('Success' , 'Hoàn tất đơn hàng thành công'); 
    }

    public function getCancelManageOrder($id , $idPayment){
        $order        = Order::where('id' , '=' , $id)->update(['status' => 3]);
        $orderDetails = Order_Details::where('order_id' , $id)->update(['status' => 3]);
        $payment      = Payment::where('id' , '=' , $idPayment)->update(['status' => 2]);

        //update coupon
        $orderCoupon  = Order::where('id' , $id)->first();
        $coupon       = Coupon::where('id' , $orderCoupon->coupon_id)->first();
        $couponTime   = $coupon->time;
        $couponTotal  = $couponTime + 1;
        $couponUpdate = Coupon::where('id' , $orderCoupon->coupon_id)->update(['time' =>  $couponTotal]);

        return Redirect::to('admin/manager/all')->with('Success' , 'Hủy đơn hàng thành công');     
    }

    public function postSendingProductManageOrder(Request $request){
        $order        = Order::where('id' , $request->id)->update(['status' => 1]);
        $orderDetails = Order_Details::where('order_id' , $request->id)->update(['status' => 1]);
        return Redirect::to('admin/manager/all')->with('Success' , 'Gửi hàng thành công'); 
    }

    public function getAllSendingProductManageOrder(){
        $order = Order::orderBy('created_at' , 'DESC')->where('status' , '=' , 1)->paginate(10);
        return view('admin.manager.sending' , compact('order'));
    }

    public function postCheckedProductManageOrder(Request $request){
        $checked = Order_Details::where('order_id' , $request->id)->where('status' , 2)->get();
        // echo "<pre>";
        // print_r($checked);
        // echo "</pre>";
        if (count($checked) == 0) {
            return Redirect::to('admin/manager/all/sending')->withErrors('Bạn chưa hoàn tất đơn hàng');        
        }else{
            $order = Order::where('id' , $request->id)->update(['status' => 2]);
            return Redirect::to('admin/manager/all/sending')->with('Success' , 'Đã giao hàng thành công và đã nhận tiền');
        }    
    }

    public function getAllCheckedProductManageOrder(){
        $order = Order::orderBy('created_at' , 'DESC')->where('status' , '=' , 2)->paginate(10);
        return view('admin.manager.checked' , compact('order'));
    }

    public function getAllCancelProductManageOrder(){
        $order = Order::orderBy('created_at' , 'DESC')->where('status' , '=' , 3)->paginate(10);
        return view('admin.manager.cancel' , compact('order'));
    }
}
