@extends('admin.layouts.admin_layout')

@section('content')

<div class="table-agile-info">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Danh sách sản phẩm
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
			            <th>Tên sản phẩm</th>
			            <th>Hình ảnh</th>
			            <th>Danh mục sản phẩm</th>
			            <th>Thương hiệu</th>
			            <th>Hiện thị</th>
			            <th>Mô tả</th>
			            <th style="width:30px;"></th>
		          	</tr>
	        	</thead>
		        <tbody>
		        	@foreach($Product as $pd)
			          	<tr>
				            <td>{{ $pd->id }}</td>
				            <td>{{ $pd->name }}</td>
				            <td><img width="100px;" src="{{URL::to('public/uploads/products/' . $pd->image)}}"></td>
				            <td>{{ $pd->category_product->name }}</td>
				            <td>{{ $pd->brand_product->name }}</td>
				            <td>
				            	@if(checkLevel(1))
				            		<span class="text-ellipsis">
					            		@if($pd->status == 1)
					            			<a <?php echo checkLevel(1); ?> href="{{URL::to('admin/product/all')}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a> 
					            		@else
					            			<a <?php echo checkLevel(1); ?> href="{{URL::to('admin/product/all')}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a> 
					            		@endif
					            	</span>
				            	@else
					            	<span class="text-ellipsis">
					            		@if($pd->status == 1)
					            			<a href="{{URL::to('admin/product/all/unactive/' . $pd->id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a> 
					            		@else
					            			<a href="{{URL::to('admin/product/all/active/' . $pd->id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a> 
					            		@endif
					            	</span>
				            	@endif
				            </td>
				            <td><span class="text-ellipsis">{{ $pd->description }}</span></td>
				            <td>
				            	@if(checkLevel(1))
				            		<a <?php echo checkLevel(1); ?> href="{{URL::to('admin/product/all')}}" class="active" ui-toggle-class="">
					              		<i class="fa fa-pencil-square-o text-success text-active">Sửa</i>
					              	</a>
				            	@else
					              	<a href="{{URL::to('admin/product/edit/' . $pd->id)}}" class="active" ui-toggle-class="">
					              		<i class="fa fa-pencil-square-o text-success text-active">Sửa</i>
					              	</a>
				              	@endif

				              	@if(checkLevel(2))
				              		<a <?php echo checkLevel(2); ?> href="{{URL::to('admin/product/all')}}" class="active" ui-toggle-class="">
				              		<i class="fa fa-times text-danger text">Xóa</i>
				              	</a>
				              	@else				              	
					              	<a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="{{URL::to('admin/product/delete/' . $pd->id)}}" class="active" ui-toggle-class="">
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
		          	<small class="text-muted inline m-t-sm m-b-sm">Tổng: {{ $Product->total() }} sản phẩm</small>
		        </div>
		        <div class="col-sm-7 text-right text-center-xs">                
		          	{{ $Product->links() }}
	    		</div>
	      	</div>
    	</footer>
  	</div>
</div>

@endsection