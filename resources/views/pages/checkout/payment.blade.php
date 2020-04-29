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
			  <li class="active">Thanh toán giỏ hàng</li>
			</ol>
		</div><!--/breadcrums-->
		<div class="checkout-options">
			<h3>Tên của bạn: {{ Session::get('name') }}</h3>
		</div><!--/checkout-options-->

		<div class="register-req">
			<p>Mời bạn chọn hình thức thanh toán</p>
		</div><!--/register-req-->

		<div class="review-payment" style="margin-bottom:30px; ">
			<h2>Xem lại giỏ hàng</h2>
		</div>

		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Hình ảnh</td>
						<td class="description">Tên sản phẩm</td>
						<td class="price">Giá</td>
						<td class="quantity">Số lượng</td>
						<td class="total">Tổng tiền</td>
						<td></td>
					</tr>
				</thead>
				<?php $content = Cart::content();  ?>
				<tbody>
					<?php $i = 0; ?>
					<form action="{{ URL::to('/cart-update') }}" method="POST">
						@foreach($content as $ct)
							<tr>
								<td class="cart_product">
									<img width="50px;" src="{{ URL::to('public/uploads/products/' . $ct->options->image)}}" alt="">
								</td>
								<td class="cart_description">
									<h4>{{ $ct->name }}<h4>
								</td>
								<td class="cart_price">
									<p>{{ number_format($ct->price) . ' đ' }}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										@csrf
										<input class="cart_quantity_input" style="width: 50px;" type="number" name="qty{{ $i }}" value="{{ $ct->qty }}" min="1">
										<input type="hidden" name="rowId{{ $i }}" value="{{ $ct->rowId }}">
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">{{ number_format($ct->price * $ct->qty) . ' đ' }}</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{ URL::to('/cart-delete-one/' . $ct->rowId) }}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<?php $i++; ?>
						@endforeach
						<tr>
							<td colspan="6" style="text-align: center;">
								<input type="submit" class="btn btn-primary" name="delete" value="Xóa tất cả sản phẩm">
							</td>
						</tr>
						<tr>
							<td colspan="6" style="text-align: center;">
								<input type="hidden" name="count" value="{{ $i }}">
								<input type="submit" class="btn btn-primary" name="update_all" value="Cập nhật sản phẩm">
							</td>
						</tr>
					</form>
				</tbody>
			</table>
		</div>
		<div class="form-group">
			@if(Session::get('subtotal'))
				<h3>Số tiền cần thanh toán: {{ number_format(Session::get('subtotal')) . ' đ' }}</h3>
			@else
				<h3>Số tiền cần thanh toán: {{ Cart::subtotal() . ' đ' }}</h3>
			@endif
		</div>
		<h4 style="margin-bottom: 40px; ">Hình thức thanh toán</h4>
		<form action="{{URL::to('/order-payment-orderdetail/add')}}" method="POST">
			{{ csrf_field() }}
			<div class="payment-options">
				<span>
					<label><input value="1" name="paymen_options" type="radio"> Trả bằng thẻ ATM</label>
				</span>
				<span>
					<label><input value="2" name="paymen_options" type="radio"> Nhận tiền mặt khi giao hàng</label>
				</span>
			</div>
			<input style="margin-top: -200px; " class="btn btn-primary" type="submit" name="payment_check" value="Hoàn tất"> 
		</form>
	</div>
</section> <!--/#cart_items-->

@endsection
