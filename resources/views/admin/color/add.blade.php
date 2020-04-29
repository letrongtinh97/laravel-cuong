@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm màu sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    	<?php alert($errors , session('Success')) ?>
                        @if(checkLevel(1))
                            <form action=""  role="form">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên màu</label>
                                    <input type="text" class="form-control" name="color_product_name" placeholder="Nhập tên màu">
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Hiển thị</label>
        	                        <select name="color_product_status" class="form-control input-sm m-bot15">
        	                            <option value="1">Có</option>
        	                            <option value="0">Không</option>
        	                        </select>
                                </div>
                                <button  <?php echo checkLevel(1) ?> type="submit" name="add_color_product" class="btn btn-info">Thêm màu</button>
                            </form>
                        @else
                            <form action="{{URL::to('admin/color/add')}}" method="post" role="form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên màu</label>
                                    <input type="text" class="form-control" name="color_product_name" placeholder="Nhập tên màu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="color_product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_color_product" class="btn btn-info">Thêm màu</button>
                            </form> 
                        @endif
                    </div>

                </div>
            </section>

    </div>
</div>

@endsection