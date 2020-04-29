@extends('admin.layouts.admin_layout')

@section('content')

<div class="table-agile-info">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Danh sách Mã giảm giá
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
			            <th>Tên mã giảm giá</th>
			            <th>Mã giảm giá</th>
			            <th>Số lượng</th>
			            <th>Tính năng mã</th>
			            <th>Số giảm</th>
			            <th style="width:30px;"></th>
		          	</tr>
	        	</thead>
		        <tbody>
		        	@foreach($coupon as $cp)
			          	<tr>
				            <td>{{ $cp->id }}</td>
				            <td>{{ $cp->name }}</td>
				            <td>{{ $cp->code }}</td>
				            <td>{{ $cp->time }}</td>
				            
				            <td>
				            	@if($cp->condition == 1)
				            		Theo phần trăm
				            	@else
				            		Theo số tiền
				            	@endif
				            </td>

				            <th>
				            	@if($cp->condition == 1)
				            		{{ $cp->number . ' %'}}
				            	@else
				            		{{ number_format($cp->number) . ' đ' }}
				            	@endif
				            </th>

				            <td>
				              	@if(checkLevel(2))
				              		<a <?php echo checkLevel(2); ?> href="{{URL::to('admin/coupon/all')}}" class="active" ui-toggle-class="">
					              		<i class="fa fa-times text-danger text">Xóa</i>
					              	</a>
				              	@else				              	
					              	<a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="{{URL::to('admin/coupon/delete/' . $cp->id)}}" class="active" ui-toggle-class="">
					              		<i class="fa fa-times text-danger text">Xóa</i>
					              	</a>
				              	@endif
				            </td>
			          	</tr>
		          	@endforeach	            
		        </tbody>
	      	</table>
	    </div>

	    <footer class="panel-footer">
	      	<div class="row">
	        
		        <div class="col-sm-5 text-center">
		          	<small class="text-muted inline m-t-sm m-b-sm">Tổng: {{ $coupon->total() }} mã khuyến mãi</small>
		        </div>
		        <div class="col-sm-7 text-right text-center-xs">                
		          	{{ $coupon->links() }}
	    		</div>
	      	</div>
    	</footer>
  	</div>
</div>

@endsection