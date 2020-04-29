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
                        <form action="{{URL::to('admin/color-details/add')}}" method="" role="form">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sản phẩm</label>
                                <select name="product_id" class="form-control input-sm m-bot15">
                                    @foreach($product as $pd)
                                        <option value="{{ $pd->id }}">{{ $pd->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tên màu</label>
                                <select name="color_id" class="form-control input-sm m-bot15">
                                    @foreach($color as $cl)
                                        <option value="{{ $cl->id }}">{{ $cl->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="color_details_status" class="form-control input-sm m-bot15">
                                    <option value="1">Có</option>
                                    <option value="0">Không</option>
                                </select>
                            </div>                     
                            <button <?php echo checkLevel(1); ?> type="submit" name="size_detail_add" class="btn btn-info">Thêm màu sản phẩm</button>
                        </form>
                    @else
                        <form action="{{URL::to('admin/color-details/add')}}" method="post" role="form">
                       	{{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sản phẩm</label>
                                <select name="product_id" class="form-control input-sm m-bot15">
                                    @foreach($product as $pd)
                                        <option value="{{ $pd->id }}">{{ $pd->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tên màu</label>
                                <select name="color_id" class="form-control input-sm m-bot15">
                                    @foreach($color as $cl)
                                        <option value="{{ $cl->id }}">{{ $cl->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                            	<label for="exampleInputPassword1">Hiển thị</label>
    	                        <select name="color_details_status" class="form-control input-sm m-bot15">
    	                            <option value="1">Có</option>
    	                            <option value="0">Không</option>
    	                        </select>
                            </div>                     
                            <button type="submit" name="size_detail_add" class="btn btn-info">Thêm màu sản phẩm</button>
                        </form>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>

@endsection