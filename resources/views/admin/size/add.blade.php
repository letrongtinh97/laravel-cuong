@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm kiểu kích cỡ
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    	<?php alert($errors , session('Success')) ?>
                        @if(checkLevel(1))
                            <form action="{{URL::to('admin/size/add')}}" method="" role="form">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên kiểu kích cỡ</label>
                                    <input type="text" class="form-control" name="size_name" placeholder="Nhập tên loại kích cỡ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="size_status" class="form-control input-sm m-bot15">
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                </div>
                                <button <?php echo checkLevel(1); ?> type="submit" name="size_add" class="btn btn-info">Thêm kiểu kích cỡ</button>
                            </form>
                        @else
                            <form action="{{URL::to('admin/size/add')}}" method="post" role="form">
                           	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên kiểu kích cỡ</label>
                                    <input type="text" class="form-control" name="size_name" placeholder="Nhập tên loại kích cỡ">
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Hiển thị</label>
        	                        <select name="size_status" class="form-control input-sm m-bot15">
        	                            <option value="1">Có</option>
        	                            <option value="0">Không</option>
        	                        </select>
                                </div>
                                <button type="submit" name="size_add" class="btn btn-info">Thêm kiểu kích cỡ</button>
                            </form>
                        @endif
                    </div>

                </div>
            </section>

    </div>
</div>

@endsection