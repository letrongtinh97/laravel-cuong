<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Product;
use App\Category_Product;
use App\Brand_Product;
use App\Customers;
use App\Checkout;
use App\Payment;
use App\Order;
use App\Order_Details;
use App\Coupon;
use Cart;
use Session;

class CheckoutController extends Controller
{
    //
    public function getCheckoutLoginShow(){
    	return view('pages.checkout.checkout_login');
    }

    public function postCheckoutLoginAddCustomers(Request $request){
    	$this->validate($request , 
    		[
       			'name'		=>	'required | min:3',
       			'email'		=>	'required | email | unique:tbl_customers,email',
       			'password'	=>	'required | min:6 | max:50',
       			'phone'		=>	'required | numeric | digits:10',       		
       		] , 
       		[
       			'name.required'		=>	'Bạn chưa nhập tên người dùng',
       			'name.min'			=>	'Tên người dùng phải có ít nhất 3 kí tự',
       			
       			'email.required'	=>	'Bạn chưa nhập email',
       			'email.email'		=>	'Bạn chưa nhập đúng định dạng email',
       			'email.unique'		=>	'Email đã tồn tại',

       			'password.required'	=>	'Bạn chưa nhập mật khẩu',
       			'password.min'		=>	'Mật khẩu phải có ít 6 kí tự',
       			'password.max'		=>	'Mật khẩu có độ dài tối đa là 50 kí tự',

       			'phone.required'	=>	'Bạn chưa nhập số điện thoại',
       			'phone.numeric'		=>	'Số điện thoại phải là số',
       			'phone.digits'		=>	'Số điện thoại phải có 10 chữ số',
       		]
       	);
    	$customers = new Customers;

    	$customers->name     = $request->name;
    	$customers->email    = $request->email;
    	$customers->password = md5($request->password);
    	$customers->phone    = $request->phone;
    	$customers->save();
    	
    	Session::put('id' , $customers->id);
    	Session::put('name' , $customers->name);
    	return Redirect::to('/trang-chu');
    }

    public function getCheckout(){
    	return view('pages.checkout.checkout_show');
    }

    public function postCheckoutAdd(Request $request){
    	$this->validate($request , 
    		[
       			'phone'		=>	'required | numeric | digits:10',
       			'address'	=>	'required',	      		
       		] , 
       		[
       			'phone.required'	=>	'Bạn chưa nhập số điện thoại',
       			'phone.numeric'		=>	'Số điện thoại phải là số',
       			'phone.digits'		=>	'Số điện thoại phải có 10 chữ số',

       			'address.required'	=>	'Vui lòng bạn hãy nhập địa chỉ',
       		]
       	);

    	$checkout = new Checkout;

    	$checkPhoneCorret = Customers::where('phone' , $request->phone)->first();
    	if ($checkPhoneCorret) {
    		$checkout->phone = $request->phone;
    	}else{
    		return Redirect::to('/checkout-show')->withErrors('Số điện thoại phải trùng với số điện thoại đăng kí tài khoản');
    	}

    	$checkout->customers_id = $request->customers_id;
    	$checkout->address      = $request->address;
    	$checkout->notes        = $request->notes;
    	$checkout->save();
      Session::put('checkout_id' , $checkout->id);
    	return Redirect::to('/payment-show');
    }

    public function getPayment(){
    	return view('pages.checkout.payment');
    }

    public function postPayment_Order_OrderDetailsAdd(Request $request){
      if (empty($request->paymen_options)) {
        return Redirect::to('/payment-show')->withErrors('Bạn chưa chọn hình thức thanh toán');
      }
      else{
        // payment
        $payment = new Payment;

        $payment->method = $request->paymen_options;
        $payment->status = 0;
        $payment->save();

        // order
        $order = new Order;

        $order->checkout_id  = Session::get('checkout_id');
        $order->customers_id = Session::get('id');
        $order->payment_id   = $payment->id;
        if (Session::get('cou')) {
          $order->total      = number_format(Session::get('subtotal'));
          $order->coupon_id  = Session::get('coupon_id');
        }else{
          $order->total      = Cart::subtotal();
        }
        $order->status       = 0;
        $order->save();

        // update time coupon
        $coupon       = Coupon::where('id' , Session::get('coupon_id'))->first();
        $couponTime   = $coupon->time;
        $couponTotal  = $couponTime - 1;
        $couponUpdate = Coupon::where('id' , Session::get('coupon_id'))->update(['time' =>  $couponTotal]);

        // order_details
        $content = Cart::content();
        foreach ($content as $ct) {
          $orderDetails = new Order_Details;

          $orderDetails->order_id              = $order->id; 
          $orderDetails->product_id            = $ct->id;
          $orderDetails->product_name          = $ct->name;
          $orderDetails->product_price         = $ct->price;
          $orderDetails->product_sale_quantity = $ct->qty;
          $orderDetails->size_color_id         = $ct->options->color;
          $orderDetails->size_details_id       = $ct->options->size;
          $orderDetails->save();
        }
        if ($payment->method == 1) {
          echo 'atm';
        }else{
          Cart::destroy();
          if (Session::get('checkout_id')) {
            Session::forget('checkout_id');
            Session::forget('cou');
            Session::forget('subtotal');
            Session::forget('coupon_id');
          }
          return Redirect::to('/handcash/thankyou');
        }
      }
    }

    public function getThankHandCash(){
      return view('pages.checkout.handcash');
    }

    public function postLoginCustomers(Request $request){
    	$this->validate($request , 
    		[
       			'email'		=>	'required | email',
       			'password'	=>	'required | min:6 | max:50',     		
       		] , 
       		[
       			'email.required'	=>	'Bạn chưa nhập email',
       			'email.email'		=>	'Bạn chưa nhập đúng định dạng email',

       			'password.required'	=>	'Bạn chưa nhập mật khẩu',
       			'password.min'		=>	'Mật khẩu phải có ít 6 kí tự',
       			'password.max'		=>	'Mật khẩu có độ dài tối đa là 50 kí tự',
       		]
       	);
    	$email     = $request->email;
    	$password  = md5($request->password);
    	$customers = Customers::where('email' , '=' , $email)->where('password' , '=' , $password)->first();
    	if ($customers) {
    		Session::put('id' , $customers->id);
    		Session::put('name' , $customers->name);
    		return Redirect::to('/trang-chu');
    	}else{
    		return Redirect::to('/login-show')->withErrors('Email hoặc mật khẩu không chính xác');
    	}
    }

    public function getLogoutCustomers(){
    	Session::flush();
    	return Redirect::to('/trang-chu');
    }
}
