@extends('admin.layouts.admin_layout')

@section('content')

<div class="table-agile-info">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Danh sách đơn hàng mới
	    </div>
	    <div class="row w3-res-tb">

	  		<div class="col-sm-3">
		        <div class="input-group">
		          	<input type="text" class="input-sm form-control" placeholder="Search">
		          	<span class="input-group-btn">
		            	<button class="btn btn-sm btn-default" type="button">Go!</button>
		          	</span>
		        </div>
	      	</div>
	    </div>
	    <?php alert($errors , session('Success')) ?>
	    <div class="table-responsive">
	      	<table class="table table-striped b-t b-light">
	        	<thead>
		          	<tr>
		            	<th>ID</th>
			            <th>Tên khách hàng</th>
			            <th>Số điện thoại</th>
			            <th>Hình thức thanh toán</th>
			            <th>Tổng tiền</th>
			            <th>Trạng thái</th>
			            <th>Yêu cầu hủy đơn hàng</th>
			            <th>Giao hàng</th>
			            <th style="width:100px;"></th>
		          	</tr>
	        	</thead>
		        <tbody>
		        	@foreach($order as $od)
			          	<tr>
				            <td>{{ $od->id }}</td>
				            <td>{{ $od->customers->name }}</td>
				            <td>{{ $od->checkout->phone }}</td>
				            @if($od->payment->method == 2)
				            	<td>Tiền mặt</td>
				            @else
				            	<td>ATM</td>
				            @endif
				            <td>{{ $od->total }}</td>
			            		@if($od->status == 0)
			            			<td>Đang chờ xử lý</td>
			            		@elseif($od->status == 1)
			            			<td>Đang giao hàng</td>
			            		@elseif($od->status == 2)
			            			<td>Đã nhận tiền</td>
			            		@elseif($od->status == 3)
			            			<td>Đã hủy đơn hàng</td>
			            		@endif
			            	
				            <td>
				            	@if($od->payment->status == 0)
				            		Không
				            	@elseif($od->payment->status == 1)
				            		<a href="{{URL::to('admin/manager/all/cancel/' . $od->id . '/' . $od->payment_id)}}">Có</a>
				            	@else
				            		Có / Đã hủy đơn hàng
				            	@endif
				            </td>
				            <td>
				            	<form action="{{URL::to('admin/manager/all/sending')}}" method="POST">
				            		{{ csrf_field() }}
				            		<input type="hidden" value="{{ $od->id }}" name="id">
				            		<input type="submit" value="Gửi hàng" name="sending">
			            		</form>
				            	
				            		{{-- <form action="{{URL::to('admin/manager/all/checked')}}" method="POST">
					            		{{ csrf_field() }}
					            		<input type="hidden" value="{{ $od->id }}" name="id">
					            		<input type="submit" value="Đã nhận tiền" name="checked">
				            		</form> --}}
				            </td>
				            <td>
				            	<a href="{{URL::to('admin/manager/details/' . $od->id)}}" class="active" ui-toggle-class="">
				              		<i class="fa fa-pencil-square-o text-success text-active">Chi tiết</i>
				              	</a>				              	
				              	{{-- <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')" href="{{URL::to('admin/manager/delete' . $od->id)}}" class="active" ui-toggle-class="">
				              		<i class="fa fa-times text-danger text">Xóa</i>
				              	</a> --}}
				            </td>
			          	</tr>
		          	@endforeach	            
		        </tbody>
	      	</table>
	    </div>

	    <footer class="panel-footer">
	      	<div class="row">
	        
		        <div class="col-sm-5 text-center">
		          	<small class="text-muted inline m-t-sm m-b-sm">Tổng: {{ $order->total() }} đơn hàng</small>
		        </div>
		        <div class="col-sm-7 text-right text-center-xs">                
		          	{{ $order->links() }}
	    		</div>
	      	</div>
    	</footer>
  	</div>
</div>

@endsection