@extends('admin.layouts.admin_layout')

@section('content')

<div class="table-agile-info">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Danh sách màu sản phẩm được yêu thích
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
			            <th>Số lượt thích</th>
		          	</tr>
	        	</thead>
		        <tbody>
		        	@foreach($product as $pd)
			          	<tr>
				            <td>{{ $pd->id }}</td>
				            <td>{{ $pd->name }}</td>
				            <td>
				            	<?php $i = 0; ?>
				            	@foreach($pd->chosen as $cs)
				            		@if($cs->status == 1)
				            			<?php $i++; ?>
				            		@endif
				            	@endforeach
				            	{{ $i }}
				            </td>
			          	</tr>
		          	@endforeach	            
		        </tbody>
	      	</table>
	    </div>

	    <footer class="panel-footer">
	      	<div class="row">
	        
		        <div class="col-sm-5 text-center">
		          	<small class="text-muted inline m-t-sm m-b-sm">Tổng: {{ $product->total() }} danh mục</small>
		        </div>
		        <div class="col-sm-7 text-right text-center-xs">                
		          	{{ $product->links() }}
	    		</div>
	      	</div>
    	</footer>
  	</div>
</div>

@endsection