@extends('master')

@section('title')
	Account - {{ $account->name }}
@endsection

@section('content')

<section id="cart_items">
	<h2 class="title text-center">Trang thông tin tài khoản: {{ $account->name }}</h2>
	<?php alert($errors , session('Success')) ?>
	<div class="">
		<div class="review-payment" style="margin-bottom:30px; ">
			<h2 style="color: #FE980F;">Lịch sử đơn hàng</h2>
			<p>Tổng đơn hàng đã mua: {{ count($orderBuy) }}</p>
			<p>Tổng đơn hàng đã đặt: {{ count($order) }}</p>
			<p>Tổng đơn hàng đã hủy: {{ count($orderDel) }}</p>
			<div class="col-sm-12" style="margin-top: 20px;">
			  	<div class="panel panel-default">
				    <div class="panel-heading">
				     	Thông tin đơn hàng đã đặt
				    </div>
				    <div class="table-responsive">
				      	<table class="table table-striped b-t b-light">
				        	<thead>
					          	<tr>
					            	<th>Tên khách hàng</th>
						            <th>Hình thức thanh toán</th>
						            <th>Tổng tiền</th>
						            <th>Trạng thái</th>
						            <th>Hủy đơn hàng</th>
					          	</tr>
				        	</thead>
					        <tbody>
					        	@foreach($order as $od)	
						          	<tr>
							            <td>{{ $od->customers->name }}</td>
							            @if($od->payment->method == 2)
							            	<td>Tiền mặt</td>
							            @else
							            	<td>ATM</td>
							            @endif
							            <td>{{ $od->total }}</td>

							            @if($od->status == 0)
					            			<td>Đang chờ xử lý...</td>
					            		@elseif($od->status == 1)
					            			<td>Đang giao hàng...</td>
					            		@elseif($od->status == 2)
					            			<td>Đã giao hàng</td>
					            		@elseif($od->status == 3)
					            			<td style="color: #999;">Đã hủy</td>
					            		@endif
					            		<td>	
					            			@if($od->payment->status == 0)
					            				@if($od->status == 2)
					            					<span style="color: #FE980F;">Không hủy đơn</span>
					            				@else
						            				<a href="{{ URL::to('/account/' . $od->customers->id . '/' . 'huy-don-hang/' . $od->payment->id ) }}">Yêu cầu hủy đơn hàng</a>
						            			@endif
							            	@elseif($od->payment->status == 1)
							            		<span style="color: #999;">Đã yêu cầu hủy/Đang chờ...</span>
							            	@else
							            		<span style="color: #999;">Đã xác nhận hủy</span>
							            	@endif
					            		</td>            		
						          	</tr>
					          	@endforeach          
					        </tbody>
				      	</table>
				    </div>
			  	</div>
			</div>
		</div>	
	</div>
</section> <!--/#cart_items-->

@endsection
