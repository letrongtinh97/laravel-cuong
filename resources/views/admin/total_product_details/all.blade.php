@extends('admin.layouts.admin_layout')

@section('content')

<div class="table-agile-info">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Danh sách chi tiết số lượng sản phẩm
	    </div>
	    <?php alert($errors , session('Success')) ?>
	    <div class="table-responsive">
	      	<table class="table table-striped b-t b-light">
	        	<thead>
		          	<tr>
		            	<th>ID</th>
			            <th>Tên sản phẩm</th>
			            <th>Kích cỡ</th>
			            <th>Màu</th>
			            <th>Hàng mới nhập</th>
			            <th>Đã bán</th>
			            <th>Hàng tồn cũ</th>
			            <th>Tổng số lượng</th>
			            <th style="width:30px;"></th>
		          	</tr>
	        	</thead>
		        <tbody>
		        	@foreach($total as $tl)
			          	<tr>
				            <td>{{ $tl->id }}</td>
				            <td>{{ $tl->product->name }}</td>
				            <td>{{ $tl->size_details->name }}</td>
				            <td>{{ $tl->color_details->color->name }}</td>
				            <td>{{ $tl->new }}</td>
				            <td>{{ $tl->sold }}</td>
							<td>{{ $tl->old }}</td>
				            <td>{{ $tl->total }}</td>
				            <td>
				              	<a href="{{URL::to('admin/total-product-details/edit/' . $tl->id)}}" class="active" ui-toggle-class="">
				              		<i class="fa fa-pencil-square-o text-success text-active">Sửa</i>
				              	</a>				              	
				              	<a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="{{URL::to('admin/total-product-details/delete/' . $tl->id)}}" class="active" ui-toggle-class="">
				              		<i class="fa fa-times text-danger text">Xóa</i>
				              	</a>
				            </td>
			          	</tr>
		          	@endforeach	            
		        </tbody>
	      	</table>
	    </div>

	    <footer class="panel-footer">
	      	<div class="row">
	        
		        <div class="col-sm-5 text-center">
		          	<small class="text-muted inline m-t-sm m-b-sm">Tổng: {{ $total->total() }} danh mục</small>
		        </div>
		        <div class="col-sm-7 text-right text-center-xs">                
		          	{{ $total->links() }}
	    		</div>
	      	</div>
    	</footer>
  	</div>
</div>

@endsection