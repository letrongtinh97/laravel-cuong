@extends('master')

@section('title')
    Cart 
@endsection

@section('content')

<?php
	$content = Cart::content(); 
	$coupon  = Session::get('cou');
?>

@if(count($content) > 0)
	<section id="cart_items">
		<h2 class="title text-center">Trang giỏ hàng</h2>
		<div class="">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ URL::to('/trang-chu') }}">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<?php alert($errors , session('Success')) ?>
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
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền <span>{{ Cart::total() . ' đ' }}</span></li>

							@if($coupon)
								@foreach($coupon as $cp)
									@if($cp['condition'] == 1)	
										<li>{{ $cp['name'] }} <span>Giảm {{ $cp['number'] }} %</span></li>
										<li>Tiền giảm 
											<span>
												<?php
													$search  = array(',' , '.00');
													$replace = array('' , '');
													$total   = str_replace($search , $replace , Cart::total());
													$couponPrice  = $cp['number'] * $total / 100;
													echo number_format($couponPrice) . '  đ';		
												?>
											</span>
										</li>
										<li>Thuế <span>{{ Cart::tax() }}</span></li>
										<li>Phí vận chuyển <span>Miễn phí</span></li>
										<li>Thành tiền 
											<span>
												<?php 
													$subtotal = $total - $couponPrice;
													echo number_format($subtotal) . ' đ';
													Session::put('subtotal' , $subtotal);
													Session::put('coupon_id' , $cp['id']);
												?>
											</span>
										</li>
									@elseif($cp['condition'] == 2)
										<li>{{ $cp['name'] }} <span>{{ number_format($cp['number']) . '  đ' }}</span></li>
										<li>Tiền giảm 
											<span>
												<?php 
													$search  = array(',' , '.00');
													$replace = array('' , '');
													$total   = str_replace($search , $replace , Cart::total());
													$couponPrice  = $cp['number'];
													echo number_format($couponPrice) . '  đ';
															
												?>
											</span>
										</li>
										<li>Thuế <span>{{ Cart::tax() }}</span></li>
										<li>Phí vận chuyển <span>Miễn phí</span></li>
										<li>Thành tiền 
											<span>
												<?php 
													$subtotal = $total - $couponPrice;
													echo number_format($subtotal) . ' đ';
													Session::put('subtotal' , $subtotal);
													Session::put('coupon_id' , $cp['id']);
												?>
											</span>
										</li>
									@endif
								@endforeach
							@else
								<li>Thuế <span>{{ Cart::tax() }}</span></li>
								<li>Phí vận chuyển <span>Miễn phí</span></li>
								<li>Thành tiền <span>{{ $subtotal = Cart::subtotal() . ' đ' }}</span></li>
							@endif
						</ul>
							@if(Session::get('id'))
								@if(Session::get('checkout_id'))
									<a class="btn btn-default check_out" href="{{ URL::to('/payment-show') }}">Thanh toán</a>
								@else
								<ul>
									@if(Session::get('cou'))
										<li style="background: #ffff !important; padding: 0px;"><a class="btn btn-default" href="{{ URL::to('/delete-coupon') }}">Xóa mã khuyến mãi</a></li>
									@else
										<form action="{{ URL::to('/check-coupon') }}" method="POST">
											@csrf
											<li style="background: #ffff !important; padding: 0px;">
												<input class="form-control" style="width: 300px;" placeholder="Nhập mã giảm giá" type="text" name="code"><br>
											</li>
											<input type="submit" value="Áp dụng mã giảm giá" class="btn btn-default check_coupon" name="check_coupon">
										</form>
									@endif
									<a class="btn btn-default check_out" href="{{ URL::to('/checkout-show') }}">Thanh toán</a>
								</ul>
								@endif
							@else
								<a class="btn btn-default check_out" href="{{ URL::to('/login-show') }}">Thanh toán</a>
							@endif
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@else 
	<?php alert($errors , session('Success')) ?>
	<h2 style="text-align: center;">Không có sản phẩm nào trong giỏ hàng</h2>
@endif

@endsection	