@extends('admin.layouts.admin_layout')

@section('content')

<div class="table-agile-info">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Chi tiết đơn hàng
	    </div>
	    <div class="table-responsive">
	    	<?php alert($errors , session('Success')) ?>
	      	<table class="table table-striped b-t b-light">
	        	<thead>
		          	<tr>
		            	<th>ID đơn hàng</th>
			            <th>Tên sản phấm</th>
			            <th>Màu</th>
			            <th>Kích cỡ</th>
			            <th>Số lượng</th>
			            <th>Đơn giá</th>
			            <th>Thành tiền</th>
			            <th>Ngày đặt hàng</th>
			            <th>Trạng thái</th>
		          	</tr>
	        	</thead>
	        	<form acction="{{ URL::to('admin/manager/details/' . $order->id) }}" method="POST" >
	        		<?php $i = 0 ?>
			        <tbody>
			        	@foreach($orderDetails as $oDT)
			        		{{ csrf_field() }}
				          	<tr>
					            <td>{{ $oDT->order_id }}</td>
					            <td>{{ $oDT->product->name }}</td>
					            <td>{{ $oDT->color_details->color->name }}</td>
					            <td>{{ $oDT->size_details->name }}</td>
					            <td>{{ $oDT->product_sale_quantity }} </td>
					            <td>{{ number_format($oDT->product_price) . ' đ' }}</td>
					            <td>{{ number_format($oDT->product_price * $oDT->product_sale_quantity) . ' đ' }}</td>
					            <td>{{ date('H:i / d-m-Y' , strtotime($oDT->created_at)) }}</td>
					            @if($oDT->status == 0)
					            	<td>Chờ xử lí</td>
					            @elseif($oDT->status == 1 )
					            	<td>Đang giao hàng</td>
					            @elseif($oDT->status == 2 )
					            	<td>Hoàn tất</td>
					            @else
					            	<td>Đã hủy</td>
					            @endif
				          	</tr>
			            	<input type="hidden" name="product_id_{{ $i }}" value="{{ $oDT->product_id }}">
			            	<input type="hidden" name="size_details_id_{{ $i }}" value="{{ $oDT->size_details_id }}">
			            	<input type="hidden" name="color_details_id_{{ $i }}" value="{{ $oDT->size_color_id }}">
			            	<input type="hidden" name="qty_{{ $i }}" value="{{ $oDT->product_sale_quantity }}">
				          	<?php $i++ ?>
			          	@endforeach          
			        </tbody>
			        <input type="hidden" name="order_id" value="{{ $order->id }}">
			        <input type="hidden" name="count" value="{{ $i }}">
			        @if($order->status == 0)
			        	<p style="float: right; margin: 20px 20px 0px 0px; color: #000; font-size: 20px;">
			        		<i class="fa fa-spinner"></i> Xin hãy xác nhận đơn hàng và giao hàng
			        	</p>
			        @elseif($order->status == 1)
			        	<input style="float: right; margin: 20px 20px 0px 0px;" type="submit" name="checked_order" value="Hoàn tất đơn hàng">
			        @elseif($order->status == 2)
			        	<p style="float: right; margin: 20px 20px 0px 0px; color: green; font-size: 20px;">
			        		<i class="fa fa-check" aria-hidden="true"></i> Giao hàng thành công
						</p>
			        @else
			        	<p style="float: right; margin: 20px 20px 0px 0px; color: red; font-size: 20px;">
				        	<i class="fa fa-times" aria-hidden="true"></i> Đơn hàng đã bị hủy
				        </p>
			        @endif
		    	</form>
	      	</table>
	    </div>
	    <footer class="panel-footer">
	      	<div class="row">		
		        <div class="col-sm-5 text-center">
		        	<h5>
		        		@if($order->coupon_id != 0)
		        			Mã khuyến mãi: {{ $order->coupon->name }} - Giảm: 
		        				@if($order->coupon->condition == 1)
		        					{{ $order->coupon->number }}%
		        				@else
		        					{{ number_format($order->coupon->number) . ' đ' }}
		        				@endif
		        		@else
		        			Đơn hàng không có mã khuyến mãi
		        		@endif
		        	</h5>
		          	<small class="text-muted inline m-t-sm m-b-sm">Tổng tiền : {{ $order->total . ' đ' }}</small>
		        </div>
	      	</div>
    	</footer>
	</div>
</div>
<br><br>
<div class="col-sm-6">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Thông tin vận chuyển
	    </div>
	    <div class="table-responsive">
	      	<table class="table table-striped b-t b-light">
	        	<thead>
		          	<tr>
		            	<th>ID</th>
			            <th>Địa chỉ</th>
			            <th>Ghi chú</th>
		          	</tr>
	        	</thead>
		        <tbody>	
		          	<tr>
			            <td>{{ $order->checkout->id }}</td>
			            <td>{{ $order->checkout->address }}</td>
			            <td>{{ $order->checkout->notes }}</td>
		          	</tr>
		          	            
		        </tbody>
	      	</table>
	    </div>
  	</div>
</div>
<div class="col-sm-6">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Thông tin khách hàng
	    </div>
	    <div class="table-responsive">
	      	<table class="table table-striped b-t b-light">
	        	<thead>
		          	<tr>
		            	<th>ID</th>
			            <th>Tên khách hàng</th>
			            <th>Email</th>
			            <th>Số điện thoại</th>       
		          	</tr>
	        	</thead>
		        <tbody>	
		          	<tr>
			            <td>{{ $order->customers->id }}</td>
			            <td>{{ $order->customers->name }}</td>
			            <td>{{ $order->customers->email }}</td>
			            <td>{{ $order->customers->phone }}</td>
		          	</tr>
		          	            
		        </tbody>
	      	</table>
	    </div>
  	</div>
</div>
@endsection