@extends('master')

@section('title')
	Thanh toán	
@endsection

@section('content')

<section id="cart_items">
	<h2 class="title text-center">Thanh toán đơn hàng</h2>
	<?php alert($errors , session('Success')) ?>
	<div class="">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="{{ URL::to('/trang-chu') }}">Home</a></li>
			  <li class="active">Thanh toán</li>
			</ol>
		</div><!--/breadcrums-->
		<div class="checkout-options">
			<h3>Tên của bạn: {{ Session::get('name') }}</h3>
		</div><!--/checkout-options-->
		@if(count(Cart::content()) > 0 )
			<div class="register-req">
				<p>Phiền bạn nhập thông tin để chúng tôi có thể giao hàng một cách tốt nhất xin cảm ơn !!</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form action="{{ URL::to('checkout-add') }}" method="POST">
									{{ csrf_field() }}
									<input type="hidden" name="customers_id" value="{{ Session::get('id') }}">
									<input type="text" name="phone" placeholder="Nhập số điện thoại">
									<input type="text" name="address" placeholder="Nhập địa chỉ">
									<textarea name="notes" placeholder="Nhập ghi chú về đơn hàng của bạn" rows="16"></textarea>
									<input class="btn btn-primary btn-sm" type="submit" name="checkout_add" value="Thanh toán">
								</form>
							</div>
						</div>
					</div>				
				</div>
			</div>
		@else
			<div class="register-req">
				<p>Bạn chưa mua hàng</p>
			</div><!--/register-req-->
		@endif
	</div>
</section> <!--/#cart_items-->

@endsection
