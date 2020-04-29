@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm kích cỡ sản phẩm chi tiết
            </header>
            <div class="panel-body">
                <div class="position-center">
                	<?php alert($errors , session('Success')) ?>
                    @if(checkLevel(1))
                        <form action="{{URL::to('admin/size-details/add')}}" method="" role="form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên loại kích cỡ</label>
                                <input type="text" class="form-control" name="size_details_name" placeholder="Nhập tên loại kích cỡ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sản phẩm</label>
                                <select name="product_id" class="form-control input-sm m-bot15">
                                    @foreach($product as $pd)
                                        <option value="{{ $pd->id }}">{{ $pd->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kích cỡ</label>
                                <select name="size_id" class="form-control input-sm m-bot15">
                                    @foreach($size as $sz)
                                        <option value="{{ $sz->id }}">{{ $sz->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="size_details_status" class="form-control input-sm m-bot15">
                                    <option value="1">Có</option>
                                    <option value="0">Không</option>
                                </select>
                            </div>
                            <button <?php echo checkLevel(1); ?> type="submit" name="size_detail_add" class="btn btn-info">Thêm kích cỡ sản phẩm</button>
                        </form>
                    @else
                        <form action="{{URL::to('admin/size-details/add')}}" method="post" role="form">
                       	{{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên loại kích cỡ</label>
                                <input type="text" class="form-control" name="size_details_name" placeholder="Nhập tên loại kích cỡ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sản phẩm</label>
                                <select name="product_id" class="form-control input-sm m-bot15">
                                    @foreach($product as $pd)
                                        <option value="{{ $pd->id }}">{{ $pd->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kích cỡ</label>
                                <select name="size_id" class="form-control input-sm m-bot15">
                                    @foreach($size as $sz)
                                        <option value="{{ $sz->id }}">{{ $sz->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                            	<label for="exampleInputPassword1">Hiển thị</label>
    	                        <select name="size_details_status" class="form-control input-sm m-bot15">
    	                            <option value="1">Có</option>
    	                            <option value="0">Không</option>
    	                        </select>
                            </div>
                            <button type="submit" name="size_detail_add" class="btn btn-info">Thêm kích cỡ sản phẩm</button>
                        </form>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>

@endsection