@extends('admin.layouts.admin_layout')

@section('content')

<div class="table-agile-info">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Danh sách kiểu kích cỡ
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
			            <th>Tên kích cỡ</th>
			            <th>Tên sản phẩm</th>
			            <th>Kiểu kích cỡ</th>
			            <th>Tên không dấu</th>
			            <th>Hiện thị</th>
			            <th style="width:30px;"></th>
		          	</tr>
	        	</thead>
		        <tbody>
		        	@foreach($sizedetails as $std)
			          	<tr>
				            <td>{{ $std->id }}</td>
				            <td>{{ $std->name }}</td>
				            <td>{{ $std->product->name }}</td>
				            <td>{{ $std->size->name }}</td>
				            <td>{{ $std->slug }}</td>
				            <td>
				            	@if(checkLevel(1))
				            		<span class="text-ellipsis">
					            		@if($std->status == 1)
					            			<a <?php echo checkLevel(1); ?> href="{{URL::to('admin/size-details/all')}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a> 
					            		@else
					            			<a <?php echo checkLevel(1); ?> href="{{URL::to('admin/size-details/all')}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a> 
					            		@endif
					            	</span>
				            	@else
					            	<span class="text-ellipsis">
					            		@if($std->status == 1)
					            			<a href="{{URL::to('admin/size-details/all/unactive/' . $std->id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a> 
					            		@else
					            			<a href="{{URL::to('admin/size-details/all/active/' . $std->id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a> 
					            		@endif
					            	</span>
				            	@endif
				            </td>
				            <td>
				            	@if(checkLevel(1))
				            		<a <?php echo checkLevel(1); ?> href="{{URL::to('admin/size-details/all')}}" class="active" ui-toggle-class="">
					              		<i class="fa fa-pencil-square-o text-success text-active">Sửa</i>
					              	</a>
				            	@else
					              	<a href="{{URL::to('admin/size-details/edit/' . $std->id)}}" class="active" ui-toggle-class="">
					              		<i class="fa fa-pencil-square-o text-success text-active">Sửa</i>
					              	</a>
				              	@endif

				              	@if(checkLevel(2))
				              		<a <?php echo checkLevel(2); ?> href="{{URL::to('admin/size-details/all')}}" class="active" ui-toggle-class="">
					              		<i class="fa fa-times text-danger text">Xóa</i>
					              	</a>
				              	@else				              	
					              	<a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="{{URL::to('admin/size-details/delete/' . $std->id)}}" class="active" ui-toggle-class="">
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
		          	<small class="text-muted inline m-t-sm m-b-sm">Tổng: {{ $sizedetails->total() }} danh mục</small>
		        </div>
		        <div class="col-sm-7 text-right text-center-xs">                
		          	{{ $sizedetails->links() }}
	    		</div>
	      	</div>
    	</footer>
  	</div>
</div>

@endsection