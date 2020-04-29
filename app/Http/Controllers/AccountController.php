<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Customers;
use App\Order;
use App\Payment;
use Cart;
use Session;

class AccountController extends Controller
{
    //
    public function getAccount($id){
    	$account  = Customers::where('id' , '=' , $id)->first();
    	$order    = Order::where('customers_id' , '=' , $id)->get();
        $orderBuy = Order::where('customers_id' , '=' , $id)->where('status' , '=' , 2)->get();
        $orderDel = Order::where('customers_id' , '=' , $id)->where('status' , '=' , 3)->get();
        // echo "<pre>";
        // print_r();
        // echo "</pre>";
    	return view('pages.account.customers' , compact('account' , 'order' , 'orderDel' , 'orderBuy'));
    }

    public function getStatusPaymentEdit($id , $idPayment){
    	$account = Customers::where('id' , '=' , $id)->first();
    	$editPaymentStatus = Payment::where('id' , '=' , $idPayment)->update(['status' => 1]);
    	
    	return Redirect::to('/account/' . $id)->with('Success' , 'Yêu cầu hủy đơn hàng thành công');
    }
}
